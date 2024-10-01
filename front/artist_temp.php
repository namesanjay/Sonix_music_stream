<?php
 if(!isset($_GET['username']))
 exit();
else
// include('temp.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head> 
<body onload="main()">
    <div id="root">Profile</div>
<script>
        async function retreive(){
            let value="<?php echo $_GET['username']?>";
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
        // const follo=async(option)=>{
        //     let array=await fetch("http://localhost/project/front/follow.php",option);
        //     let response=await array.text();
        //     console.log(response);
        //     return response;
        // }
        // const artist_profile=async (artist)=>{
        //     console.log(artist)
        //     let div=document.createElement('div');
        //     div.className='profile';

        //     let name=document.createElement('h2')
        //     name.textContent=artist[0].name
        //     console.log(artist)
        //     console.log(artist[0].name)
        //     console.log(name)

        //     let img=document.createElement('img')
        //     img.src=`../user_image/${artist[0].image}`;

        //     let follow=document.createElement('h4')
        //     follow.textContent=artist[0].followers;


        //     let button=document.createElement('button')
        //     button.textContent="follow";
        


        //     button.onclick=async function(){
                // let data="<?php echo $_GET['username']?>";
        //         let option={
        //             method:"POST",
        //             headers:{
        //             'Content-Type':'application/json'
        //         },
        //         body:JSON.stringify(data)
        //         };
        //         let response=await follo(option)
        //         alert(response);
        //     }
        //     div.appendChild(name)
        //     div.appendChild(img)
        //     div.appendChild(button)
        //     div.appendChild(follow)
        //     div.appendChild(descrip)
        //     return div;
        // }



        // function sng_com(song){
        //     console.log("song-com");
        //     let div=document.createElement('div');
        //     div.className="song-item";

        //     const al_name=document.createElement('p');
        //     al_name.textContent=song.album_name;
        //     al_name.className="song-album";

        //     const image=document.createElement('img');
        //     image.src=`../album_image/${song.thumbnail}`;

        //     let singer=document.createElement('p');
        //     if(song.collab_singer1_name || song.collab_singer2_name || song.collab_singer3_name || song.collab_singer4_name){
        //     if(song.collab_singer1_name==null)
        //     song.collab_singer1_name="";
        //      if(song.collab_singer2_name==null)
        //     song.collab_singer2_name=""
        //      if(song.collab_singer3_name==null)
        //     song.collab_singer3_name=""
        //     if(song.collab_singer4_name==null)
        //     song.collab_singer4_name=""

        // singer.textContent=`${song.singer_name} ft ${song.collab_singer1_name} ${song.collab_singer2_name} ${song.collab_singer3_name} ${song.collab_singer4_name}`;
        // }else
        // singer.textContent=`${song.singer_name}`;


        //     // const singer=document.createElement('h3');
        //     // singer.textContent=`${song.singer_name} ft. ${sing1} ${sing2} ${sing3} ${sing4}`;
        //     singer.className="song-artist";
        //     // console.log(singer);

        //     const title=document.createElement('p');
        //     title.textContent=song.title
        //     title.className="song-title";

        //     let label=document.createElement('label');
        //     label.id="lab";
        //     label.textContent=song.song_id;

        //     div.onclick=div.onclick = function() {
        //     func1(song.song_id,song.audio);
        // };
        //     div.appendChild(label);
        //     div.appendChild(image);
        //     div.appendChild(title);
        //     div.appendChild(singer);
        //     div.appendChild(al_name);
        //     return div;

        // }

        async function main(){
            let data=await retreive();
            console.log(data);
            let root=document.getElementById('root');
            let art_profile=artist_profile(data.artist);
            root.appendChild(art_profile);
            let div=document.createElement('div')
            div.className='song';
            root.appendChild(div);

            for(let i=0;i<data.song.length;i++){
                let song_profile=sng_com(data.song[i])
                div.appendChild(song_profile);
            }
        }
    </script>
</body>
</html>




<!-- <style>
        .profile{
    height:56px;
    width:100%;
    border:1px solid black;
    margin-top:2px;
    display: flex;
  flex-wrap: wrap;
  /* /* justify-content:space-evenly;  */
  align-items:center;
  font-size:20px;
  font-weight: 700;
}
.profile>img{
    height:40px;
    width:40px;
    margin-left:10px;
    margin-bottom: 5px;
}
.song-item{
    height:56px;
    width:100%;
    border:1px solid black;
    margin-top:2px;
    display: flex;
  flex-wrap: wrap;
  /* /* justify-content:space-evenly;  */
  align-items:center;
  font-size:20px;
  font-weight: 700;
}
.song-item>img{
    height:40px;
    width:40px;
    margin-left:10px;
    margin-bottom: 5px;
}

.song-artist{
    flex: 1;
    text-align: center;
    /* height: 100%; */
}
.song-album{
    flex:1;
    text-align: right;
    margin-right: 20px;
}
.song-title{
    flex:1;
    text-align: left;
    margin-left:20px;
}

#lab{
    visibility: hidden;
}

    </style> -->