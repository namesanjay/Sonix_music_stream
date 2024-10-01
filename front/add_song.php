<?php
include("index.php");
include("temp.php");
if(!isset($_SESSION['artist_username']))
exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

#root{
        background-image:url('../icon/back.png');
        height:663px;
        width:1240px;
        position:absolute;
        top:166px;
        left:402px;
    }

         .file-upload{
        height:406px;
        width:430px;
        background-color:#571A4F;
        display:flex;
        justify-content:center;
        align-items:center;
        border-radius:40px;
        position:relative;
    top:74px;
    left:103px;
    }
    
.file-upload input[type="file"] {
    display: none;
}
.file-upload>img{
    height:110px;
    width:100px;
}

    input[type="text"]{
        height:69px;
        width:509px;
        border-radius:25px;
        font-size:24px;
        position:absolute;
        left:620px;
    }
    #album{
        top:89px;
    }
    #title{
        top:178px;
    }
    #col1{
        top:267px;
    }
    #col2{
        top:356px;
    }
    #col3{
        top:445px;
    }
    #col4{
        top:534px;
    }

    #btn{
        height:66px;
        width:252px;
        border-radius:50px;
        background-color:#F5793E;
        position:absolute;
        top:562px;
        left:192px;
        font-size:30px;
        color:white;
    }
    </style>
</head>
<body>
    <div id="root">
    <form id="myform">
        <input type="text" name="album" id="album" placeholder="Album Name" required><br/>
        <input type="text" name="title" id="title" placeholder="Song_name" required><br/>
        <div class='file-upload' onclick="document.getElementById('audio').click()">
        <img src="../icon/upl.png" >
        <input type="file" name="audio" id="audio" required hidden><br/>
        </div>
        <input type="text" id="col1" name="Singer1" class="colab" placeholder="Colab Singer1 username"><br/>
        <input type="text" id="col2" name="Singer2" class="colab" placeholder="Colab Singer2 username"><br/>
        <input type="text" id="col3" name="Singer3" class="colab" placeholder="Colab Singer3 username"><br/>
        <input type="text" id="col4" name="Singer4" class="colab" placeholder="Colab Singer4 username"><br/>
        <button type="submit" id="btn">Submit</button>
    </form>
    </div>
    <script>
        // function to validate the album
      async  function check(){
            console.log("check2")
            let album_name=document.getElementById('album').value;
            const data={
                'album':album_name
            };
            let array=await fetch("http://localhost/project/validate/check_album.php",{
                method:"POST",
                header:{
                    'Content-type':'application/json'
                },
                body:JSON.stringify(data)
            })
            let v=await array.text();
            console.log(v)
            return v;
        }

        // function to validate audio file

        function AudioFile() {
        let filename=document.getElementById('audio').value
        // console.log(filename)

        const audioExtensions = ['mp3', 'wav', 'ogg', 'flac', 'aac', 'm4a', 'wma', 'aiff', 'alac'];
        function getFileExtension(filename) {
        const match = filename.toLowerCase().match(/\.([^.]+)$/);
        return match ? match[1] : null;
        }
        const extension = getFileExtension(filename);
        if( audioExtensions.includes(extension))
        return true;
        return false
        }   

        async function validate_singer(arr){
            let val=[];
            for( let i=0;i<arr.length;i++){
            if(arr[i]!=null){
                let data={
                    'user':arr[i]
                };
                let array=await fetch("http://localhost/project/validate/check_singer.php",{
                    method:'POST',
                    header:{
                        'Content-type':'application/json'
                    },
                    body:JSON.stringify(data)
                })
                let response=await array.text();
                // let temp=Number.parseInt(response)
                if(response==='0'){
                alert(`Singer is not valid in ${i} colab singer`);
                val.push(false)
                console.log('inside')
                }
                else if(response==='3'){
                alert(`ColabSinger in ${i}  same a colab singer`);
                val.push(false)
                console.log('inside')
                }
                else
                val.push(true)
            }
            else
            val.push(null)
            }
            console.log("check1")
            return val;
        }

        function sing(array){
            for(let i=0;i<array.length;i++){
                if(array[i]==false)
                return false;
            }
            return true;
        }
       

        async function upload(formData){
            console.log("form");
            let data={
                method:"POST",
                body:formData
            };
            let array=await fetch("http://localhost/project/validate/upload_song.php",data)
            let response=await array.text();
            return response;
        }



        // main function
        document.getElementById('myform').addEventListener('submit',async function(e){
            e.preventDefault();

            // album validation
            let album=await check();
            album!='1'?alert("Album doesnot exist"):alert("thik xa");
            


             // audio file validation
            let audio=AudioFile();
            audio?alert('Correct extension'):alert('audio extension incorrect')
            let check2
           
            // validate singer
            let sing_data=document.getElementsByClassName('colab')
            let arr=[]
            for(let i=0;i<sing_data.length;i++){
                if(sing_data[i].value=="")
                arr.push(null)
                else
                arr.push(sing_data[i].value)
                
            }
            let valid=await validate_singer(arr)
            console.log(valid)
            let sing_valid=sing(valid);
            console.log(sing_valid);
            
            if(album && audio && sing_valid){
               for(let i=0;i<arr.length;i++){
                if(arr[i]==null)
                sing_data[i].value=null;
                }

                const formData=new FormData(this);
                let up=await upload(formData);
                // let response=up.text()
                // alert(response);
                console.log("value=",up)
            }
           })

        


    </script>
</body>
</html>