<?php
include("index.php");
include('temp.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         #cover{
        height:380px;
        width:380px;
        border-radius:50%;
        position:relative;
        left:30px;
    }
    .artist>h1{
        font-size:30px;
        position:relative;
        left:50px;


    }
    .artist{
        height:500px;
        width:1000px;
        background: #22173a;
        position:relative;
        left:50px;
        /* top:20px; */
        color:white;
        margin-bottom:20px;
        border-radius:25px;
    }
    .artist>h2{
        position:relative;
        left:50px;
    }
    .song-item{
    height:101px;
    width:1000px;
    border-radius:25px;
    border:2px solid blue;
    margin-top:10px;
    background:#22173A;
    color:white;
    position:relative;
    left:50px;
    z-index:0;
}

.song-item>img{
    height:65px;
    width:65px;
    position:relative;
    top:15px;
    left:36px;
    
}
.song-item>h4{
    font-size:20px;
    position:relative;
    bottom:40px;
    left:136px;
}
#root{
    position:relative;
    left:400px;
}
.song-item>h3{
    font-size:30px;
    position:relative;
    left:136px;
    bottom:50px;
}
.remove,.update,.play{
    height:50px;
    width:80px;
    font-size:22px;
    position:relative;
    bottom:127px;
    left:750px;
    border-radius:10px;
}
.song-item>h5{
    position:relative;
    bottom:90px;
    left:700px;
    font-size:25px;
}
    </style>
</head>
<body onload="main4()">
    <div id="root">
    </div>
    <script>
        async function retrieve(user){
            let data={
                method:"POST",
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify(user),
                mode:'cors'
            };
            let array=await fetch("http://localhost/project/front/artist_profile.php",data);
            let response=await array.json();
            console.log("response");
            console.log(response);
            return response;
        }

        function art_profile(data){
            let div=document.createElement('div');
            div.className='artist'
            let img=document.createElement('img')
            img.src=`../user_image/${data.image}`;
            img.id="cover";
            let name=document.createElement('h1');
            name.textContent=data.name
            // let flw=Number.parseInt(data.followers)
            let followers=document.createElement('h2');
            followers.textContent="Followers="+data.followers;
            
            div.appendChild(img);
            div.appendChild(name);
            div.appendChild(followers);
            // div.appendChild(artist);
            return div;
        }
        async function remov(id){
            let data={
         method:"POST",
         headers:{
            'Content-Type':'application/json'
         },
        body:JSON.stringify(id)
        }
            let array=await fetch("http://localhost/project/delete/delete_song.php",data);
            let response=await array.text();
            return response;
        }
        async function run(title,sing,cover,id){
    console.log(title)
    let audio=document.getElementById('audio')
    let dow=document.getElementById('download')
    const playPauseBtn = document.getElementById('pause');
    let s_id=document.getElementById('song_id');
    console.log("s_id",s_id)
    console.log(dow);
    console.log(JSON.stringify(id))
    let value={
        "id":id
    }
    let data={
        method:"POST",
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify(value)
    }
    let array=await fetch("http://localhost/project/front/song_view.php",data)
    let response=await array.text();
    alert(response)
    audio.src=`../audio/${response}`;
    dow.href=`../audio/${response}`;
    // alert(response)
    console.log(response)

    dow.download=`${title}.mp3`;
   
    dow.parentElement.load;

    s_id.textContent=id;
    console.log("s_id",s_id)

    console.log(audio)

    audio.parentElement.load;


    let song_cover=document.getElementById('alb_cov')

    let song_title=document.getElementsByClassName('song-title')[0];
    let song_artist=document.getElementsByClassName('song-artist')[0];
    
    song_title.textContent=title
    song_artist.textContent=sing
    song_cover.src=`../album_image/${cover}`
    playPauseBtn.innerHTML = '&#10074;&#10074;';
    audio.play();
   
}
        function sng_com(song,check){
            console.log("song-com");
            let div=document.createElement('div');
            div.className="song-item";

            let listen=document.createElement('h5')
            listen.textContent=song.listen
            
            
            const image=document.createElement('img');
            image.src=`../album_image/${song.thumbnail}`;

            let singer=document.createElement('h4');
            if(song.collab_singer1_name || song.collab_singer2_name || song.collab_singer3_name || song.collab_singer4_name){
            if(song.collab_singer1_name==null)
            song.collab_singer1_name="";
             if(song.collab_singer2_name==null)
            song.collab_singer2_name=""
             if(song.collab_singer3_name==null)
            song.collab_singer3_name=""
            if(song.collab_singer4_name==null)
            song.collab_singer4_name=""

        singer.textContent=`${song.name} ft ${song.collab_singer1_name} ${song.collab_singer2_name} ${song.collab_singer3_name} ${song.collab_singer4_name}`;
        }else
        singer.textContent=`${song.name}`;




            const title=document.createElement('h3');
            title.textContent=song.title
            title.className="song-title";

       
            let play=document.createElement('button');
            play.className="play";
            play.textContent='play';
            play.onclick = async function() {
            run(song.title,singer.textContent,song.thumbnail,song.song_id);
            };

            div.appendChild(image);
            div.appendChild(title);
            div.appendChild(singer);
            div.appendChild(listen)
            div.appendChild(play);

            if(check){
                let remove=document.createElement('button');
                remove.className="remove";
                let update=document.createElement('button');
                update.className="update";
                remove.textContent="remove"
                update.textContent="update"
                remove.onclick=async function(){
                    remov(song.song_id)
                }
                update.onclick=function(){
                    window.location.href="http://localhost/project/front/update_song.php?id="+encodeURIComponent(song.song_id)
                }
                div.appendChild(remove)
                div.appendChild(update)

            }
            // div.appendChild(label);
            
            // div.appendChild(al_name);
            return div;

        }
        async function main4(){
            console.log("muji")
            let user="<?php echo $_SESSION['username']?>";
            console.log("muji2")
            let data=await retrieve(user);

            let root=document.getElementById('root')
            let art_com=art_profile(data.artist[0])
            root.appendChild(art_com);
            console.log(data.artist[0])


            for(let i=0;i<data.main.length;i++){
                let song_com=sng_com(data.main[i],true)
                root.appendChild(song_com)
            }
            for(let i=0;i<data.feat.length;i++){
                let song_com=sng_com(data.feat[i],false)
                root.appendChild(song_com)
            }
        }
    </script>
</body>
</html>