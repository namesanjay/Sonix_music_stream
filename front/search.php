<?php

include("temp.php");

// session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
    <style>
    body{
        background-color:#4F407A;
        z-index:0;
    }
    #myform{
    display: flex;
    align-items: center;
    border: 2px solid #8a2be2;
    border-radius: 25px;
    background-color: #e0e0e0;
    padding: 10px;
    width:550px;
    font-weight:700;
    margin-bottom:100px;
    position:relative;
    top:20px;
    left:200px;
    }

.search-bar {
    border: none;
    background: none;
    outline: none;
    padding: 5px;
    font-size: 16px;
    /* flex-grow: 1; */
    width:500px;
}

.search-button {
    background-color: #8a2be2;
    border: none;
    border-radius: 25px;
    color: white;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
}

.search-button:hover {
    background-color: #6a1bb8;
}

.artist>img{
    height:228px;
    width:240px;
    border-radius: 50%;
    position:relative;
    left:15px;
    top:10px;
}
.artist{
    height:360px;
    width:400px;
    border-radius:25px;
    background:#22173A;
    color:white;
    margin-top:10px;
    /* border:2px solid black; */
    position:relative;
    left:50px;
}
.artist>h3{
    font-size:30px;
    font-weight:bold;
    position:relative;
    top:10px;
    left:20px;
}
.artist>h4{
    font-size:20px;
    position:relative;
    /* bottom:20px; */
    top:20px;
    left:20px;
}
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
#cont{
    position:relative;
    left:400px;
    width:80%;
    height:80vh;
    
}
    </style>
</head>
<body>
    <div id="cont">
    <form id="myform">
    <input type="text" class="search-bar" id="search" name="search" placeholder="Search...">
        <button class="search-button" type="submit">Search</button>
    </form>
  <div id="root"></div>
  </div>
    <script>
        async function search(){
            let sea=document.getElementById('search').value;
            let data={
                method:"POST",
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify(sea),
                mode:'cors'
            };
            let array=await fetch("http://localhost/project/search/search.php",data);
            let response=await array.json();
            console.log("response");
            return response;

        }
        function artist_search(message){
            // console.log("http://localhost/project/front/artist.php?username="+encodeURIComponent(message))
            window.location.href="http://localhost/project/front/artist.php?username="+encodeURIComponent(message);

        }
        function artist_com(artist){
            let div=document.createElement('div');
            div.className="artist";

            const img=document.createElement('img');
            img.src=`../user_image/${artist.image}`;
            

            const h3=document.createElement('h3');
            h3.textContent=artist.name;

            const cate=document.createElement('h4')
            cate.textContent="Artist";

            div.onclick=function(){
                artist_search(artist.artist_username);
            }
            
            div.appendChild(img);
            div.appendChild(h3);
            div.appendChild(cate)
            return div;
        }
        function album_search(message){
            // window.location.href="http://localhost/project/front/artist.php?username="+encodeURIComponent(message);
        }
        // function album_com(album){
        //     let div=document.createElement('div');
        //     div.className="album"


        //     const al_name=document.createElement('h3');
        //     al_name.textContent=album.album_name;

        //     const u_name=document.createElement('h3');
        //     u_name.textContent=album.name;

        //     const image=document.createElement('img');
        //     image.src=`../album_image/${album.thumbnail}`;

        //     // const h1=document.createElement('h3');
        //     // h1.textContent="Album";
        //     div.onclick=function(){
        //         album_search(album.album_name)
        //     }

        //     // div.appendChild(h1);
        //     div.appendChild(al_name);
        //     div.appendChild(u_name);
        //     div.appendChild(image);

        //     return div;
        // }

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
        

        document.getElementById('myform').addEventListener('submit',async function(e){
            // location.reload();
            e.preventDefault();
            let root=document.getElementById('root');
            root.innerHTML="";
            console.log(root);
            let valid=await search();
            console.log(valid);
            console.log(valid.artist);
            console.log(valid.album);
            console.log(valid.songs);
            let artist_len=valid.artist.length;
    
            console.log(artist_len);
            if(artist_len>0){
                const art=document.createElement('div');
                art.id="art";
                root.appendChild(art);
                for(let i=0;i<artist_len;i++){
                    let artistElement=artist_com(valid.artist[i]);
                    art.appendChild(artistElement);
                }
            }
            // let album_len=valid.album.length;
            // console.log(album_len);
            // if(album_len>0){
            //     const alb=document.createElement('div');
            //     alb.id="alb";
            //     root.appendChild(alb);
            //     for(let i=0;i<album_len;i++){
            //         let albumElement=album_com(valid.album[i]);
            //         alb.appendChild(albumElement);
            //     }
            // }



            let sng_len=valid.songs.length;
            console.log(sng_len);
            if(sng_len>0){
                const sng=document.createElement('div');
                sng.id="sng";
                console.log("djvbkdfv");
                root.appendChild(sng);
                for(let i=0;i<sng_len;i++){
                    let sngElement=sng_com(valid.songs[i]);
                    sng.appendChild(sngElement);
                }
            }
            // console.log(valid.songs[0].title);

        })

    </script>
</body>
</html>