<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .song-item{
    height:101px;
    width:921px;
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
    </style>
</head>
<body onload="main6()">
    <div id="root"></div>
    <script>
        async function retreive(value){
            let data={
        method:"POST",
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify(value)
        }
        let array=await fetch("http://localhost/project/search/album_list.php",data)
        let response=await array.json();
        return response;
        }
        function song_com(song){
    
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
        }

        function sng_com(song){
            console.log("song-com");
            let div=document.createElement('div');
            div.className="song-item";

            // const al_name=document.createElement('h3');
            // al_name.textContent=song.album_name;
            // al_name.className="song-album";

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


            // const singer=document.createElement('h3');
            // singer.textContent=`${song.singer_name} ft. ${sing1} ${sing2} ${sing3} ${sing4}`;
            singer.className="song-artist";
            // console.log(singer);

            const title=document.createElement('h4');
            title.textContent=song.title
            title.className="song-title";

            // let label=document.createElement('label');
            // label.id="lab";
            // label.textContent=song.song_id;

            div.onclick = async function() {
            run(song.title,singer.textContent,song.thumbnail,song.song_id);
        };
            // div.appendChild(label);
            div.appendChild(image);
            div.appendChild(title);
            div.appendChild(singer);
            // div.appendChild(al_name);
            return div;

        }
        async function main6(){
            let value="<?php $_GET['album']?>"
            let data=await retreive(value);
            console.log(data)
        }
    </script>
</body>
</html>