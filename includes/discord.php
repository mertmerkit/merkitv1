<div id="discordAdvert" class="position-fixed top-0 align-items-center justify-content-center bottom-0 m-auto w-100 h-100" style="background:rgb(0,0,0,0.5);right:0;left:0;z-index:9999;display:flex;transition:0.35s;opacity:0">
     <div class="position-relative rounded overflow-hidden" style="width:80%;max-width:500px;aspect-ratio:1/1">
          <a href="https://discord.gg/kcejYJmqCb">
			  <img class="w-100 h-100 object-fit-cover" src="<?php echo $discord_photo ?>" alt="">
		 <a>
          <div onclick="closeDiscord()" class="position-absolute end-0 top-0 close py-2 px-2  " style="z-index:999999;background:darkred;cursor:pointer"><i class="fa fa-close" aria-hidden="true"></i></div>
     </div>
</div>


<script>
       // Function to close Discord advert
       var ad = document.getElementById('discordAdvert');
       ad.style.display = 'none';

        addEventListener("load", (event) => {
                ad.style.display = 'flex';
        });


       function closeDiscord() {
            ad.style.display = 'none';
            localStorage.setItem('discordAdvertClosed', 'true'); // Set item in localStorage
        }

        // Function to check localStorage and hide advert if necessary
        function checkDiscordAdvert() {
            var ad = document.getElementById('discordAdvert');
            var advertClosed = localStorage.getItem('discordAdvertClosed');
            if (advertClosed === 'true') {
                ad.style.display = 'none';
            }
        }

        // Run check on page load
        window.onload = function() {
            checkDiscordAdvert();
            ad.style.opacity = '1';
        }

     
</script>