
async function component(){
    
    let array=await fetch("http://localhost/project/front/data.php");
    let response=await array.json();
    return response;
}

function album_com(album){
    const alb=document.createElement('div');
    alb.className="alb";
    
    let img=document.createElement('img');
    img.src=`../album_image/${album.thumbnail}`;
    
    let title=document.createElement('h3');
    title.textContent=album.album_name;

    let singer=document.createElement('h4');
    singer.textContent=album.name;

    // let br=document.createElement('br');
    alb.appendChild(img);
    alb.appendChild(title);
    // alb.appendChild()
    alb.appendChild(singer);

    alb.onclick=function(){
        window.location.href="http://localhost/project/front/album_view.php?album="+encodeURIComponent(album.album_name);
    }
    return alb;
}
function artist_com(artist){
    const art=document.createElement('div');
    art.className="art";

    let img=document.createElement('img');
    img.src=`../user_image/${artist.image}`;

    let h4=document.createElement('h4');
    h4.textContent=artist.name;

    art.onclick=function(){
        // alert
        window.location.href="http://localhost/project/front/artist.php?username="+encodeURIComponent(artist.artist_username);
    }
    art.appendChild(img);
    art.appendChild(h4);

    return art;
}

function song_com(song){
    
    const sng=document.createElement('div');
    sng.className="sng";

    let img=document.createElement('img');
    img.src=`../album_image/${song.thumbnail}`;

    let label=document.createElement('label')
    label.textContent=song.song_id;
    label.id="lab";


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

        singer.textContent=`${song.singer_name}  ${song.collab_singer1_name} ${song.collab_singer2_name} ${song.collab_singer3_name} ${song.collab_singer4_name}`;
    }else
    singer.textContent=`${song.singer_name}`;

    let title=document.createElement('p')
    title.textContent=song.title

    let br=document.createElement('br')
    sng.appendChild(img);
    sng.appendChild(title)
    sng.appendChild(br)
    sng.appendChild(singer);
    sng.appendChild(label)

    sng.onclick=function(e){
        // console.log(song)
        let filename=song.audio
        console.log(singer)
        let sing=singer.textContent
        console.log(filename,title,singer)
        run(title.textContent,sing,song.thumbnail,song.song_id)
    }
    return sng;
        
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
async function main(){
    let object=await component();
    console.log(object);
    // console.log(object);
    
    let artist=document.getElementsByClassName('division')[0];
    let album=document.getElementsByClassName('division')[1];
    let song=document.getElementsByClassName('division')[2];

    for(let i=0;i<object.album.length;i++){
        let albumElement=album_com(object.album[i]);
        album.appendChild(albumElement);
    }

    for(let i=0;i<object.artist.length;i++){
        let artistElement=artist_com(object.artist[i]);
        artist.appendChild(artistElement);
    }

    for(let i=0;i<object.song.length;i++){
        let songElement=song_com(object.song[i]);
        song.appendChild(songElement);
    }
}