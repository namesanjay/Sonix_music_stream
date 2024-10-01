<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/ef743757f1.js" crossorigin="anonymous"></script>
    <!-- <script src="index.js"></script> -->
    <style>
       
        .player {
            display: flex;
            flex-direction: row;
            align-items: center;
            background-color: #29294e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            gap: 20px;
            width: 100%;
            position:fixed;
            height:50px;
            bottom:0;
            z-index:3;
            /* max-width: 1200px; */
        }
        .album-cover img {
            width: 100px;
            height: 100px;
            border-radius: 5px;
        }

        .song-info {
            text-align: left;
            flex: 1;
        }
        .controls {
            display: flex;
            align-items: center;
            gap: 10px;
            position:relative;
            left:100px;
        }
        .control-btn {
            font-size: 24px;
            background: none;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .control-btn:hover {
            color: #1db954;
        }

        #progress {
            cursor: pointer;
            width: 200px;
            margin: 0 10px;
            flex-grow: 0.5;
        }
        #volume {
            cursor: pointer;
            width: 50%;
            margin: 0 10px;
            flex-grow: 0.25;
        }
        .time {
            font-size: 14px;
            white-space: nowrap;
        }

        #progress-container{
            display: flex;
            align-items: center;
            width: 1000px;
            position:relative;
            left:200px;
        }
        #volume-container {
            display: flex;
            align-items: center;
            width: 400px;
        }
        #like{
            font-size:20px;
        }
    </style>
</head>
    <div class="sidebar">
        <header>Sonix</header>
        
        <ul>
            <li><a href="home.php">Home Page</a></li>
            <li><a href="">Search</a></li>
            <li><a href="home.php">Followed Artist</a></li>
            <li><a href="liked_song.php">Liked Song</a></li>
            <?php
                session_start();
                if(isset($_SESSION['artist_username']))
                echo "<li><a href='./artist/'>Artist</a></li>";
                else{
                    echo "<li><a href='#'>Create as Artist</a></li>";
                }
            ?>
        </ul>
    </div>
    <audio src="#" id="audio"></audio>
    <p id="song_id" hidden>#</p>
    <div class="player">
        <div class="album-cover">
            <img src="#" id="alb_cov" alt="Album Cover">
        </div>
        <div class="song-info">
            <h3 class="song-title">Song title</h3>
            <p class="song-artist">Song Artist</p>
        </div>
        <div class="controls">
            <button id="previous" class="control-btn">&#9664;&#9664;</button>
            <button id="pause" class="control-btn">&#9658;</button>
            <button id="next" class="control-btn">&#9654;&#9654;</button>
            <i class="fa-solid fa-heart" id="like"></i>
            <a href="#" id="download" download="#" class="control-btn">&#8681;</a>
        </div>
        <div id="progress-container">
            <span id="currentTime">0:00</span>
            <input type="range" id="progress" value="0" min="0" max="100">
            <!-- <div class="time"> -->
                <span id="duration">0:30</span>
            <!-- </div> -->
        </div>
        <div id="volume-container">
            <h3>Volume</h3>
            <input type="range" id="volume" value="100" min="0" max="100">
        </div>
    </div>
    
    <script>

        document.addEventListener('DOMContentLoaded',loading());
        function loading() {
    console.log('loaded muji');
    const audio = document.getElementById('audio');
    const playPauseBtn = document.getElementById('pause');
    const progress = document.getElementById('progress');
    const volume = document.getElementById('volume');
    const currentTimeEl = document.getElementById('currentTime');
    const durationEl = document.getElementById('duration');
    const like=document.getElementById('like');
    pause.addEventListener('click', function() {
        if (audio.paused) {
            audio.play();
            playPauseBtn.innerHTML ='&#10074;&#10074;';
        } else {
            audio.pause();
            playPauseBtn.innerHTML = '&#9658;';
        }
    });

    audio.addEventListener('timeupdate', function() {
        const currentTime = audio.currentTime;
        const duration = audio.duration;
        progress.value = (currentTime / duration) * 100;
        currentTimeEl.textContent = formatTime(currentTime);
        durationEl.textContent = formatTime(duration);
        console.log(durationEl)
    });

    progress.addEventListener('input', function() {
        const duration = audio.duration;
        audio.currentTime = (progress.value / 100) * duration;
    });
    volume.addEventListener('input', function() {
        audio.volume = volume.value / 100;
    });
    audio.addEventListener('loadedmetadata', function() {
        durationEl.textContent = formatTime(audio.duration);
    });

    like.addEventListener('click',async function(){
        console.log("mitra")
        let id=document.getElementById('song_id').textContent
        console.log("id vitra=",id);
        let data={
        method:"POST",
        headers:{
            'Content-Type':'application/json'
        },
        body:JSON.stringify(id)
        };

        let array=await fetch("http://localhost/project/front/like.php",data);
        let response=await array.text();
        alert(response);
    })

    function formatTime(time) {
        const minutes = Math.floor(time / 60);
        const seconds = Math.floor(time % 60);
        return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }
    // let isViewCounted = false;


    // audioPlayer.addEventListener('play', () => {
    //             // Check if audio is playing from the beginning
    // if (audio.currentTime === 0 && !isViewCounted) 
    //         isViewCounted = true; // Set flag to prevent multiple view counts for the same start
    // });

    // audioPlayer.addEventListener('ended', () => {
    //             isViewCounted = false; // Reset the flag when the audio ends
    // });

}

    </script>
</body>
</html>