const questionImage = document.getElementById('questionImage');
const startBtn = document.querySelector('.start-btn');
const popupInfo = document.querySelector('.popup-info');
const exitBtn = document.querySelector('.exit-btn');
const main = document.querySelector('.main');
const continueBtn = document.querySelector('.continue-btn');
const quizSection = document.querySelector('.quiz-section');
const quizBox = document.querySelector('.quiz-box');
const resultBox = document.querySelector('.result-box');
const tryAgainBtn = document.querySelector('.tryAgain-btn');
const nextBtn = document.querySelector('.next-btn');

startBtn.onclick = () => {
    popupInfo.classList.add('active');
    main.classList.add('active');
}

exitBtn.onclick = () => {
    popupInfo.classList.remove('active');
    main.classList.remove('active');
}

continueBtn.onclick = () => {
    quizSection.classList.add('active');
    popupInfo.classList.remove('active');
    main.classList.remove('active');
    quizBox.classList.add('active');

    showQuestions(0);
    questionCounter(1);
    headerScore();
}

tryAgainBtn.onclick = () => {
    quizBox.classList.add('active');
    nextBtn.classList.remove('active');
    resultBox.classList.remove('active');

    questionCount = 0;
    questionNumb = 1;
    userScore = 0;
    showQuestions(questionCount);
    questionCounter(questionNumb);
    headerScore();
    resetOptions();
}

let questionCount = 0;
let questionNumb = 1;
let userScore = 0;

nextBtn.onclick = () => {
    if (questionCount < questions.length - 1) {
        questionCount++;
        showQuestions(questionCount);

        questionNumb++;
        questionCounter(questionNumb);

        nextBtn.classList.remove('active');
        resetOptions();
    } else {
        showResultBox();
    }
}

const optionList = document.querySelector('.option-list');

function showQuestions(index) {
    const questionText = document.querySelector('.question-text');
    questionText.textContent = `${questions[index].numb}. ${questions[index].question}`;

    // Set the image source dynamically
    questionImage.src = questions[index].img;

    let optionTag = `<div class="option"><span> ${questions[index].options[0]}</span></div>
    <div class="option"><span> ${questions[index].options[1]}</span></div>`;

    optionList.innerHTML = optionTag;

    const option = document.querySelectorAll('.option');
    for (let i = 0; i < option.length; i++) {
        option[i].setAttribute('onclick', 'optionSelected(this)');
    }
}

function optionSelected(answer) {
    if (!answer.classList.contains('disabled')) {
        let userAnswer = answer.textContent.trim();
        let correctAnswer = questions[questionCount].answer.trim();

        if (userAnswer === correctAnswer) {
            answer.classList.add('correct');
            userScore += 1;
            headerScore();
        } else {
            answer.classList.add('incorrect');
            // Highlight the correct answer
            for (let i = 0; i < optionList.children.length; i++) {
                if (optionList.children[i].textContent.trim() === correctAnswer) {
                    optionList.children[i].classList.add('correct');
                }
            }
        }

        disableOptions();
        nextBtn.classList.add('active');
    }
}

function disableOptions() {
    for (let i = 0; i < optionList.children.length; i++) {
        optionList.children[i].classList.add('disabled');
    }
}

function resetOptions() {
    for (let i = 0; i < optionList.children.length; i++) {
        optionList.children[i].classList.remove('correct', 'incorrect', 'disabled');
    }
}

function questionCounter(index) {
    const questionTotal = document.querySelector('.question-total');
    questionTotal.textContent = `${index} of ${questions.length} Questions`;
}

function headerScore() {
    const headerScoreText = document.querySelector('.header-score');
    headerScoreText.textContent = `Score: ${userScore} / ${questions.length}`;
}

function showResultBox() {
    quizBox.classList.remove('active');
    resultBox.classList.add('active');

    const scoreText = document.querySelector('.score-text');
    scoreText.textContent = `Your Score ${userScore} out of ${questions.length}`;

    let remark = "";

    // Set remarks based on the user's score
    if (userScore >= 4) {
        remark = "You are not vulnerable to phishing attacks.";
    } else {
        remark = "You are vulnerable to phishing attacks.";
    }

    const remarkText = document.createElement('p');
    remarkText.textContent = remark;
    remarkText.classList.add('remark-text'); // Add a class for styling
    resultBox.appendChild(remarkText);

    const circularProgress = document.querySelector('.circular-progress');
    const progressValue = document.querySelector('.progress-value');
    let progressStartValue = 0;
    let progressEndValue = (userScore / questions.length) * 100;
    let speed = 20;

    let progress = setInterval(() => {
        progressStartValue++;
        progressValue.textContent = `${progressStartValue}%`;
        if (progressStartValue == progressEndValue) {
            clearInterval(progress);
        }
    }, speed);
}
