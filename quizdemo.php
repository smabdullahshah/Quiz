<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quiz</title>
<style>
    @import url(https://fonts.googleapis.com/css?family=Oxygen|Pacifico);
    body {
    font-family: 'Oxygen', sans-serif;
    width: 100%;
    min-height: 100vh;
    background-image: linear-gradient(to right, rgba(38, 142, 255, 0.8), rgba(91, 117, 255, 0.7)), url(./images/4lFaK0nLxZbu.png);
    background-repeat: no-repeat;
    background-position: center top;
    background-size: cover;
    overflow: hidden;
    }

    header {
    text-align: center;
    }

    header h1 {
    font-family: 'Pacifico', cursive;
    font-size: 3.5em;
    margin: 0;
    color: #ff0080;
    }

    header p {
    color:#ff00bf ;
    }

    form {
    width: 100%;
    margin: 40px auto 1em;
     }

    .form-quiz-group {
    width: 50%;
    padding: 1.5em 2.5em 3em;
    border-radius: 5px;
    margin: 0 auto 10px;
    display: none;
    }

    .active-group {
    display: block;
    }

    .quiz-score {
    background-color:#fff;
    width: 60%;
    margin: 0 auto;
    padding: 1em 1.5em;
    border-radius: 5px;
    text-align: center;
    }
    .quiz-score-number {
      font-size: 35px;
      font-weight: 600;
      color: #000;
    }
    .quiz-score-message {
    font-family: 'Pacifico', cursive;
    font-size: 2.5em;
    margin: 0;
    color: #bc4749;
    }
    #timer {
      font-size: 28px;
      font-weight: 600;
      border: 3px solid;
      border-radius: 25px;
      padding: 5px;
    }
    .form-quiz-group-question {
    line-height: 1.7;
    color: #000;
    font-size: 30px;
    font-weight: 600;
    background: #fff;
    border-radius: 25px;
    padding: 1px 20px;
    }

    .form-quiz-group-option {
      margin: 43px 7px 0;
    height: 33px;
    width: 73px;
    }

    .form-quiz-group-label {
    color: #565656;
    list-style-type: none;
    } 
    .form-quiz-group label  {
      color: #000;
    font-size: 35px;
    background: #fff;
    border-radius: 25px;
    padding: 1px 20px;
    }
  
    .form-quiz-next,
    .form-quiz-prev {
      font-size: 33px;
    font-weight: 600;
    background: linear-gradient(45deg, #bc4749 50%, #f5f5f5 50%);
    background-size: 200% 100%;
    color: #fff;
    border: none;
    text-decoration: none;
    padding: 15px 30px;
  border-radius: 10px;
  transition: background-position 0.5s ease;
}
.button-wrap {
  display: flex;
    justify-content: space-evenly;
}
.form-quiz-next:hover,
    .form-quiz-prev:hover {
  background-position: -100% 0;
  color: #000;
}

  
</style>
</head>
<body>
  <div style="display: flex;justify-content: space-around;align-items: center;">
    <div><a href=""><img src=""></a></div>
    <div><span id="timer">05:00</span></div>
  </div>
 
<div class="form">
  <form action="" id="formQuiz" class="form-quiz">
  </form>
  <div class="quiz-score">
    <h2 class="quiz-score-message">Thankyou <br>For your Participation!</h2>
    <p class="quiz-score-number"></p>
    <h2 class="quiz-score-message"><a href="quiz.html" class="">More Quiz</a></h2>
  </div>
  <div class="button-wrap">
    <a href="#" class="form-quiz-prev">Back</a>
    <a href="#" class="form-quiz-next">Next</a>
  </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
  var questions = [{
    question: '1. What Question? ',
    choices: ["А. Answer 1. ", "B Answer 2. ", "C Answer 3. "],
    correct: 0
  }, {
    question: '2. How Question?',
    choices: ["А. Answer 1.", "B Answer 2.", "C Answer 3."],
    correct: 0
  }, {
    question: '3. Where Question?',
    choices: ["А. Answer 1.", "B Answer 2.", "C Answer 3."],
    correct: 0
  }, {
    question: '4. When Question? ',
    choices: ["А. Answer 1. ", "B Answer 2.", "C Answer 3."],
    correct: 0
  }, {
    question: '5. Which Question? ',
    choices: ["А. Answer 1. ", "B Answer 2.", "C Answer 3."],
    correct: 0
  }];

  var score = 0;

  function main() {
    $('.quiz-score').hide();
    populate();

    $('.form-quiz-next').click(function() {
      var currentQuestion = $('.active-group');
      var nextQuestion = currentQuestion.next();

      var selectedChoice = currentQuestion.find('input:checked').val();
      var correctAnswer = questions[currentQuestion.index()].choices[questions[currentQuestion.index()].correct];

      if (selectedChoice === correctAnswer) {
        score += 1;
      }

      if (nextQuestion.length === 0) {
        $('.form-quiz-next').hide();
        $('.form-quiz-prev').hide();
        $('#formQuiz').hide();
        $('#timer').hide();

        $('.quiz-score').show();
        $('.quiz-score-number').text('Congratulations! Your score is ' + score);
      }

      currentQuestion.removeClass('active-group').fadeOut(100);
      nextQuestion.addClass('active-group').fadeIn(200);
    });

    $('.form-quiz-prev').click(function() {
      var currentQuestion = $('.active-group');
      var previousQuestion = currentQuestion.prev();

      $('.form-quiz-next').show(); // Show next button when going back

      currentQuestion.removeClass('active-group').fadeOut(50);
      previousQuestion.addClass('active-group').fadeIn(50);
    });

    $('.form-quiz-group:first-child').addClass('active-group');
  }

  function populate() {
    var theForm = document.getElementById("formQuiz");

    for (var index = 0; index < questions.length; index++) {
      var container = document.createElement('div');
      container.className = "form-quiz-group";

      var question = document.createElement('p');
      question.className = "form-quiz-group-question";
      question.innerHTML = questions[index].question;

      var choiceBox = document.createElement('div');
      choiceBox.className = "form-quiz-group-choices-q" + index;

      var choices = questions[index].choices;

      theForm.appendChild(container);
      container.appendChild(question);
      container.appendChild(choiceBox);

      for (var j = 0; j < choices.length; j++) {
        var label = document.createElement('label');
        label.innerHTML = choices[j] + '<br>';

        var choice = document.createElement('input');
        choice.className = "form-quiz-group-option";
        choice.setAttribute('type', 'radio');
        choice.setAttribute('name', 'choices' + index);
        choice.setAttribute('value', choices[j]);

        choiceBox.appendChild(choice);
        choiceBox.appendChild(label);
      }
    }
  }

  $(document).ready(main);
</script>
<script>
  var timeLimitInMinutes = 5;
    var timeLimitInSeconds = timeLimitInMinutes * 60;
    var timerElement = document.getElementById('timer');
    
    function startTimer() {
      timeLimitInSeconds--;
      var minutes = Math.floor(timeLimitInSeconds / 60);
      var seconds = timeLimitInSeconds % 60;
    
      if (timeLimitInSeconds < 0) {
        timerElement.textContent = '00:00';
        clearInterval(timerInterval);
        return;
      }
    
      if (minutes < 10) {
        minutes = '0' + minutes;
      }
      if (seconds < 10) {
        seconds = '0' + seconds;
      }
    
      timerElement.textContent = minutes + ':' + seconds;
    }
    
    var timerInterval = setInterval(startTimer, 1000);
    </script>
</body>
</html>
