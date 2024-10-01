<?php
 if(!isset($_GET['username']))
 exit();
else
include('temp.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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
    font-size:30px;
    position:relative;
    bottom:60px;
    left:136px;
}
.song-item>p{
    font-size:28px;
    position:relative;
    bottom:60px;
    left:136px;
}
    #cover{
        height:380px;
        width:380px;
        border-radius:50%;
        position:relative;
        left:30px;
    }
    .artist>h1{
        font-size:40px;
        position:relative;
        left:50px;
    }
    .artist>button{
        background-color:green;
        position:relative;
        bottom:100px;
        left:300px;
        height:50px;
        width:150px;
        font-size:30px;
        font-weight:700;
    }
    button:hover{
        background:red;
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
    body{
        background:#4F407A;
    }
    #root{
        position:relative;
        left:350px;
    }
    .artist>h2,.artist>h3{
        position:relative;
        left:50px;
    }
    </style>
</head> 
<body onload="main()">
    <div id="root"></div>
<script>
        async function retreive(value){
            
            let data={
                method:"POST",
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify(value)
            };
        let array=await fetch("http://localhost/project/search/search_artist.php",data);
        let response=await array.json();
        return response;
        }
        async function follow_check(value){
            let data={
                method:"POST",
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify(value)
            };
            let array=await fetch("http://localhost/project/search/follow_check.php",data);
            let response=await array.text();
            return response;
        }
        async function unfollow(user){
            let data={
                method:"POST",
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify(user)
            };
            let array=await fetch("http://localhost/project/search/unfollow.php",data);
            let response=await array.text();
            return response;
        }
        async function follow(user){
            let data={
                method:"POST",
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify(user)
            };
            let array=await fetch("http://localhost/project/search/follow.php",data);
            let response=await array.text();
            return response;
        }


        function art_profile(data,check){
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
            let artist=document.createElement('h3');
            artist.textContent="Artist";
            let button=document.createElement('button');
            if(check=="true"){
                button.textContent="following";
                button.onclick=async function(){
                    await unfollow(data.artist_username);
                    button.textContent="follow";
                    // flw=flw-1
                    // followers.textContent="Followers="+flw;
                }
            }else{
                button.textContent="follow";
                button.onclick=async function(){
                    await follow(data.artist_username);
                    button.textContent="following";
                    // followers.textContent="Followers="+flw+1;
                }
            }
            div.appendChild(img);
            div.appendChild(name);
            div.appendChild(followers);
            div.appendChild(artist);
            div.appendChild(button);
            return div;
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



        function song_com(song){
            console.log("song-com");
            let div=document.createElement('div');
            div.className="song-item";

            const image=document.createElement('img');
            image.src=`../album_image/${song.thumbnail}`;

            let singer=document.createElement('p');
            if(song.collab_singer1_name || song.collab_singer2_name || song.collab_singer3_name || song.collab_singer4_name){
            if(song.collab_singer1_name==null)
            song.collab_singer1_name="";
             if(song.collab_singer2_name==null)
            song.collab_singer2_name=""
             if(song.collab_singer3_name==null)
            song.collab_singer3_name=""
            if(song.collab_singer4_name==null)
            song.collab_singer4_name=""

        singer.textContent=`${song.singer_name} ft ${song.collab_singer1_name} ${song.collab_singer2_name} ${song.collab_singer3_name} ${song.collab_singer4_name}`;
        }else
        singer.textContent=`${song.singer_name}`;


            
            singer.className="song-artist";
        

            const title=document.createElement('h4');
            title.textContent=song.title
            title.className="song-title";


            div.onclick = async function() {
            run(song.title,singer.textContent,song.thumbnail,song.song_id);
        };
    
            div.appendChild(image);
            div.appendChild(title);
            div.appendChild(singer);
            return div;

        }
        async function main(){
            let singer="<?php echo $_GET['username']?>";
            let data=await retreive(singer);
            // console.log(data.song)console.log(data.artist[0])
            let followed=await follow_check(singer);
            let root=document.getElementById('root');
            let profile=art_profile(data.artist[0],followed)
            root.appendChild(profile);

            for(let i=0;i<data.song.length;i++){
                let song=song_com(data.song[i])
                root.appendChild(song)
            }
            // let song=song_com(data.)

        }
</script>
</html>