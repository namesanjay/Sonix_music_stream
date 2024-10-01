<?php
    include("temp.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #root{
            position:relative;
            left:400px;
        }
        .song{
         height:101px;
    width:921px;
    border-radius:25px;
    border:2px solid blue;
    margin-top:10px;
    background:#22173A;
    color:white;
    z-index:0;
}

.song>img{
    height:65px;
    width:65px;
    position:relative;

    top:25px;
    left:36px;
    
}
.song>h2{
    font-size:30px;
    position:relative;
    bottom:60px;
    left:136px;

}
.song>h4{
    font-size:30px;
    position:relative;
    left:136px;
    bottom:50px;
}
.remove{
    height:50px;
    width:100px;
    font-size:22px;
    position:relative;
    bottom:140px;
    left:750px;
    border-radius:10px;
}
.song>p{
    font-size:22px;
    position:relative;
    bottom:110px;
    left:600px;
    border-radius:10px;
}
    </style>
</head>
<body onload="main1()">
    <!-- <button onclick="main1()">Muji</button> -->
     <div id="root"></div>
    <script>
        async function main1(){
            console.log("muji");
            let song={
                method:"POST"
            };
            let array=await fetch('http://localhost/project/front/liked_request.php',song);
            let response=await array.json();
            console.log(response);
            console.log(response.length)
            let root=document.getElementById('root')
            for(let i=0;i<response.length;i++){
                root.appendChild(addElem(response[i]))
            }

        }
        function addElem(song){
                console.log(song)
                let div=document.createElement('div')
                div.className='song';
                
                let img=document.createElement('img');
                img.src=`../album_image/${song.thumbnail}`;

                let title=document.createElement('h2')
                title.textContent=song.title;

                let singer=document.createElement('h4');
                singer.textContent=song.name

                let album=document.createElement('p');
                album.textContent=song.album_name

                let button=document.createElement('Button')
                button.className='remove'
                button.textContent='Remove';
                button.onclick=async function(){
                    remov(song.song_id);
                }
                div.onclick=async function(){
                    run(song.audio,song.song_id,song.title,song.name,song.thumbnail);
                }
                div.appendChild(img)
                div.appendChild(title)
                div.appendChild(singer)
                div.appendChild(album)
                div.appendChild(button)
                return div
            }
            async function run(aud,id,title,name,cover){
                     console.log(title)
                    let audio=document.getElementById('audio')
                    let dow=document.getElementById('download')
                    const playPauseBtn = document.getElementById('pause');
                    let s_id=document.getElementById('song_id');
                    
                    console.log(audio,dow)
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
                    // audio.src=`../audio/${aud}`;
                    // dow.href=`../audio/${aud}`;
                    console.log(aud)
                    console.log(dow)
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
                song_artist.textContent=name
                song_cover.src=`../album_image/${cover}`
                playPauseBtn.innerHTML = '&#10074;&#10074;';
                audio.play();
            }
            async function remov(id){
                let value={
                    "id":id
                };
                let data={
                    method:"POST",
                    headers:{
                        'Content-Type':'application/json'
                     },
                    body:JSON.stringify(value)
                };

                let array=await fetch('http://localhost/project/front/remove_like.php',data);
                let response=await array.text();
                console.log(response);

            }
    </script>
</body>
</html>