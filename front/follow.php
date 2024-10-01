<?php
include('temp.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .art_com{
            height:101px;
    width:921px;
    border-radius:25px;
    border:2px solid blue;
    margin-top:10px;
    background:#22173A;
    color:white;
        }
        .art_com>img{
            height:65px;
          width:65px;
            position:relative;
    top:15px;
    left:36px;
        }

        .art_com>h1{
            font-size:30px;
    position:relative;
    bottom:40px;
    left:136px;
        }
    #main3{
        position:relative;
        left:400px;
    }
    </style>
</head>
<body onload="main2()">
    <div id="main3"><h1>Followed Artist</h1></div>
    <script>
        async function retriv(){

            let value="<?php echo $_SESSION['username']?>";
            // let value='anish10';
            let data={
                method:"POST",
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify(value)
            };

           let array=await fetch('http://localhost/project/search/follow_artist.php',data);
           let response=await array.json();
           return response; 
        }
        function artist_com(data){
            console.log("Data=",data)
            let div=document.createElement('div');
            div.className='art_com';


            let img=document.createElement('img')
            img.src=`../user_image/${data.image}`

            let h1=document.createElement('h1')
            h1.textContent=data.name

            div.onclick=function(){
                window.location.href="http://localhost/project/front/artist.php?username="+encodeURIComponent(data.Username);
            }

            div.appendChild(img)
            div.appendChild(h1)
            return div;
        }
        async function main2(){
            let array=await retriv();
            let root=document.getElementById('main3')
            // console.log(array.artist[0])
            // consolel.log(array.)
            for(let i=0;i<array.artist.length;i++){
                let art_com=artist_com(array.artist[i])
                root.appendChild(art_com)
            }
            // console.log(array.artist[0])

        }
    </script>
</body>
</html>