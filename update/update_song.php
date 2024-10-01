<?php
    if(isset($_SESSION['artist_username']))
    exit();
    include('temp.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="myform">
        <input type="text" name="id" id="id" value="#" hidden>
        <input type="text" name="album" id="album" placeholder="Album Name" ><br/>
        <input type="text" name="title" id="title" placeholder="Song_name"><br/>
        <input type="text" name="Singer1" class="colab" placeholder="Colab Singer1 username"><br/>
        <input type="text" name="Singer2" class="colab" placeholder="Colab Singer2 username"><br/>
        <input type="text" name="Singer3" class="colab" placeholder="Colab Singer3 username"><br/>
        <input type="text" name="Singer4" class="colab" placeholder="Colab Singer4 username"><br/>
        <button type="submit">Submit</button>
    </form>
    <script>
        // function to validate the album
      async  function check(){
            console.log("muji")
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
            console.log("muji")
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
            console.log("Rando");
            let data={
                method:"POST",
                body:formData
            };
            let array=await fetch("http://localhost/project/update/update_song_data.php",data)
            let response=await array.text();
            return response;
        }



        // main function
        document.getElementById('myform').addEventListener('submit',async function(e){
            e.preventDefault();

            // album validation
            let album=await check();
            album!='1'?alert("Album doesnot exist"):alert("thik xa");
            
            document.getElementById('id').value="<?php echo $_GET['id'] ?>"


             // audio file validation
           
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
            
            if(album && sing_valid){
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