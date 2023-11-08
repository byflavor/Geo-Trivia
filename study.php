<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="studystyle1.css">
        <title>Study Time!</title>
    </head>
    <body>
        <?php include "./navbar.php"?>
       <div class="welcome">Set aside a time to help you review for the quiz before your next attempt.
           Use this productivity timer to help you! Enter a custom time and reload the page 
           to start a new session:
       </div>
       <div class = "timerdiv" id="timerdiv"></div>
       <br><br>
       <center>
           <label for "time"> Enter the time, in minutes, you would like to study</label>
           <input type = number id="time"></input><br><br>
              <input type="button" id="timerbutton" value="Start Timer" class = "button" onclick="startTimer()"><br><br>
            <div class="welcome">Use these links to help you study and review geography concepts
            before you start your next attempt:</div><br><br>
            <div class="imageContainer">Geography Quizlet</div>
            <a href="https://quizlet.com/15511191/geography-study-guide-flash-cards/" target="_blank"><img src="geography1.jpg"  style="width:300px;height:300px;"></a>
            <br><br><div class="imageContainer">Brittanica Introduction</div>
            <a href="https://www.britannica.com/science/geography" target="_blank"><img src="geography2.jpg"  style="width:300px;height:300px;"></a>
            <br><br><div class="imageContainer">AP Human Geography Study Guide</div>
            <a href="https://www.albert.io/blog/ap-human-geography-review/" target="_blank"><img src="geography3.jpg"  style="width:300px;height:300px;"></a>
        </center>
        

      <!-- custom js -->
      <script>

          //color changer function for buttons
          function changeColor(color) {
              document.body.style.background = color;
          }

          var id="";
          //starts timer
          var timerGoing = false;

          function startTimer() {
              if(timerGoing) {
                  return;
              }
              document.getElementById("timerdiv").style.backgroundColor="#de6763";
              changeColor('#fffa99');
              if (document.getElementById("time").value== "") {
                  document.getElementById("timer").innerHTML ="Please enter a valid time!";
              }
              else{
                  changeColor('#D95550');
                  var seconds = 60;
                  var mins = document.getElementById("time").value;
                  function clock() {
                      timerGoing = true; //keeps track of if the timer has already started so that settimeout doesnt overlap
                      var counter = document.getElementById("timerdiv");
                      var current_minutes = mins-1
                      seconds--;
                      counter.innerHTML = current_minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds); //adds a 0 if seconds are less than 10
                      if(seconds > 0) {
                          setTimeout(clock, 1000);
                      } else {
                          if(mins > 1){
                              countdown(mins-1);
                             
                          }
                      }
                  }
                  clock();
                  timerGoing = false;
              }
          }

      </script>
   </body>
</html>
