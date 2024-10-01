<?php
include('index.php');
include('temp.php');
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
        .album{
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
.album>img{
    height:65px;
    width:65px;
    position:relative;
    top:15px;
    left:36px;
}
.album>h1{
    font-size:25px;
    position:relative;
    left:140px;
    bottom:60px;
}
.album>h2{
    position:relative;
    left:140px;
    bottom:75px;
}
.album>h3{
    position:relative;
    left:140px;
    bottom:20px;
}
.remove,.update{
    height:50px;
    width:100px;
    font-size:22px;
    position:relative;
    bottom:127px;
    left:750px;
    border-radius:10px;
}
    </style>
</head>
<body onload="main5()">
    <div id="root"></div>
    <script >
        async function result(value){
            let data={
                method:"POST",
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify(value)
            };
            let array=await fetch("http://localhost/project/search/album.php",data);
            let response=await array.json();
            console.log(response)
            return response;
        }
        async function remov(value){
            let data={
                method:"POST",
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify(value)
            };
            let array=await fetch("http://localhost/project/delete/delete_album_data.php",data)
            let response=await array.text();
            return response;
        }
        function album_component(data){
            let div=document.createElement('div')
            div.className='album'

            let image=document.createElement('img')
            image.src=`../album_image/${data.thumbnail}`

            let name=document.createElement('h1')
            name.textContent=data.album_name

            let year=document.createElement('h3')
            year.textContent=data.release_year

            let genre=document.createElement('h2')
            genre.textContent=data.genre

            let update=document.createElement('button')
            update.className="update"
            update.textContent='Update'
            let remove=document.createElement('button')
            remove.className="remove"
            remove.textContent="Remove"

            update.onclick=function(){
                window.location.href="http://localhost/project/front/update_album.php?album="+encodeURIComponent(data.album_name)
            }

            remove.onclick= async function(){
                remov(data.album_name)
            }
            div.appendChild(image);
            div.appendChild(name)
            div.appendChild(year);
            div.appendChild(genre);
            div.appendChild(update);
            div.appendChild(remove);
            return div;
        }
        async function main5(){
            let value="<?php echo $_SESSION['artist_username']; ?>"
            let array=await result(value);
            console.log(array[0])
            console.log(array[1])
            console.log(array.length)
            let root=document.getElementById('root')
            for(let i=0;i<array.length;i++){
                let alb_com=album_component(array[i])
                root.appendChild(alb_com);
            }
        }
    </script>
</body>
</html>