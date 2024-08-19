var witchX = witchCoordinates[currentSection].x;
var witchY = witchCoordinates[currentSection].y;

document.addEventListener('DOMContentLoaded', function() {
    var witchElement = document.getElementById('witch');
    var isDragging = false;
    var startX, startY, initialX, initialY;

    witchElement.addEventListener('mousedown', function(e) {
        isDragging = true;
        startX = e.clientX;
        startY = e.clientY;
        initialX = witchElement.offsetLeft;
        initialY = witchElement.offsetTop;
        document.body.style.cursor = 'grabbing'; // 改变光标样式
    });

    document.addEventListener('mousemove', function(e) {
        if (isDragging) {
            var moveX = e.clientX - startX;
            var moveY = e.clientY - startY;
            witchElement.style.left = initialX + moveX + 'px';
            witchElement.style.top = initialY + moveY + 'px';
        }
    });

    document.addEventListener('mouseup', function() {
        isDragging = false;
        document.body.style.cursor = 'default'; // 恢复光标样式
    });
});

function initWitchPosition() {
    console.log("Witch initial position: X=" + witchX + ", Y=" + witchY);
}

initWitchPosition();
var witchWidth = 20;
var witchHeight = 20;
var mazeWidth = 800;
var mazeHeight = 333;
var timer;
var timeLeft = timeLeft; 
var currentQuestionIndex = currentQuestionIndex; 
var chestMessageShown = {};

var maze = [
    // frame
    [0, 0, 800, 0],[0, 333, 800, 0],[0, 0, 0, 160],[0, 200, 0, 333],[800, 0, 0, 333],

    // left
    [0, 80, 100, 2],[100, 81, 0, 20],
    [100, 0, 0, 45],[50, 25, 0, 20],[50, 45, 100, 0],[150, 46, 0, 20],
    [0, 160, 100, 0],[50, 110, 0, 50],[100, 160, 0, 55], 
    [0, 200, 50, 0],[50, 200, 0, 20],
    [0, 270, 50, 0],[50, 250, 0, 20],[50, 250, 50, 0],
    [100, 300, 0, 30],[50, 300, 50, 0],
    [150, 100, 0, 25],[150, 100, 50, 0],[200, 40, 0, 60],
    [310, 0, 0, 35],[250, 35, 60, 0],[285, 36, 0, 30],
    [345, 65, 100, 0],[380, 36, 0, 30],[400, 66, 0, 32],
    [345, 65, 100, 0],[445, 36, 0, 30],[445, 35, 100, 0],[545, 36, 0, 30],[545, 65, 80, 0],
    [150, 300, 250, 0],[350, 265, 0, 35],[150, 265, 0, 35],

    // right
    [710, 3, 0, 30],[710, 32, 50, 0],[760, 32, 0, 150],
    [670, 40, 0, 45],[670, 85, 40, 0],[710, 85, 0, 40],[710, 125, 50, 0],
    [710, 220, 100, 0],[710, 220, 0, 40],
    [750, 260, 50, 0],[750, 260, 0, 40],
    [620, 300, 130, 0],[620, 280, 0, 20],
    [670, 160, 40, 0],[710, 160, 0, 25],[670, 185, 40, 0],[670, 185, 0, 25],[590, 210, 80, 0],
    [400, 300, 0, 31],[400, 300, 150, 0],[550, 250, 0, 50],[480, 250, 180, 0],
    
    // middle
    [250, 100, 370, 0],[250, 100, 0, 35],[250, 175, 0, 35],[620, 100, 0, 110],
    [150, 210, 500, 0],[150, 160, 0, 49],[100, 160, 50, 0],
    [215, 135, 35, 0],[215, 175, 35, 0],
    [215, 260, 85, 0],[415, 210, 0, 55],[300, 210, 0, 51],
]

var chestPositions = [
    [260, 110],
    [160, 60],
    [670, 95],
    [500, 260],
    [250, 220], 
];

function startGame() {
    sessionStorage.setItem('startTime', Date.now());
    startTimer();
}

function startTimer() {
    timer = setInterval(function() {
        if (currentQuestionIndex >=5) {
            clearInterval(timer);
            var finalMinutes = Math.floor(timeLeft / 60);
            var finalSeconds = timeLeft % 60;
            if (finalSeconds < 10) {
                finalSeconds = '0' + finalSeconds;
            }
            var finalTime = finalMinutes + ':' + finalSeconds;
            document.getElementById('timer').textContent = finalTime;
        }

        var minutes = Math.floor(timeLeft / 60);
        var seconds = timeLeft % 60;
        if (seconds < 10) {
            seconds = '0' + seconds;
        }
        document.getElementById('timer').textContent = minutes + ':' + seconds;

        if (timeLeft <= 0) {
            clearInterval(timer);
            document.getElementById('timer').textContent = '00:00';
            showTimeoutMessage();
            return;
        }
        timeLeft--;
    }, 1000);
}

function showModal(event) {
    event.preventDefault(); 
    clearInterval(timer); 
    document.getElementById('stop-modal').style.display = 'block'; 
}

function hideModal() {
    document.getElementById('stop-modal').style.display = 'none'; 
    startTimer(); 
}

function replayGame() {
    window.location.href = 'episode4.php?reset=true';
}

function endGame() {
    window.location.href = '../user/homepage.php'; 
}

function showTimeoutMessage() {
    var messageModal = document.getElementById('timeoutModal');
    if (messageModal) {
        messageModal.style.display = 'block'; 
    } else {
        console.error('Timeout modal element not found');
    }
}

function showChestMessage(section) {
    console.log("showChestMessage called for section: ", section);
    if (!chestMessageShown[section]) {
        var messageText = '';

        if (section === currentQuestionIndex) {
            messageText = "You have reached Section " + section + ". Click ok to start the question.";
        } else if (section < currentQuestionIndex) {
            messageText = "You have already completed Section " + section + ".";
        } else {
            messageText = "You haven't unlocked Section " + section + " yet. Complete the previous sections to unlock it.";
        }

        console.log("Message Text: ", messageText);
        document.getElementById('messageText').textContent = messageText;
        document.getElementById('messageModal').style.display = 'block';

        chestMessageShown[section] = true;

        if (section === currentQuestionIndex) {
            var okButton = document.createElement('button');
            okButton.textContent = 'OK';
            okButton.classList.add('ok-button', '-button');
            okButton.onclick = function() {
                document.getElementById('messageModal').style.display = 'none';
                document.getElementById('question-container').style.display = 'block';
            };
            document.querySelector('.modal-content').appendChild(okButton);
        }
    }
}

function showLockedMessage(section) {
    var message = '';

    if (section < currentQuestionIndex) {
        message = "You have already completed Section " + section + ".";
    } else {
        message = "You haven't unlocked Section " + section + " yet.<br><br>Complete the previous sections to unlock it.";
    }

    document.getElementById('messageText').innerHTML = message;
    document.getElementById('messageModal').style.display = 'block';
}

function closeMessageModal() {
    document.getElementById('messageModal').style.display = 'none';
}
function fetchHint() {
    var section = currentQuestionIndex;
    document.querySelectorAll('.hintText, .hintOkButton').forEach(function(el) {
        el.style.display = 'none';
    });

    document.querySelectorAll('.question, .options, .hint-button').forEach(function(el) {
        el.style.display = 'none';
    });

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'question_option_hint4.php?getHint=true&section=' + section, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            var hintElement = document.getElementById('hintText' + section);
            var hintOkButton = document.getElementById('hintOkButton' + section);
            hintElement.textContent = '💡Hint: ' + xhr.responseText;
            hintElement.style.display = 'block';
            hintOkButton.style.display = 'block';
            console.log('Hint fetched:', xhr.responseText);
        } else {
            console.error('Failed to fetch hint:', xhr.statusText);
        }
    };
    xhr.onerror = function() {
        console.error('Request error...');
    };
    xhr.send();
}

function drawMaze() {
    var canvas = document.getElementById('mazeCanvas');
    var ctx = canvas.getContext('2d');

    ctx.clearRect(0, 0, canvas.width, canvas.height);

    ctx.strokeStyle = '#9900ff';
    ctx.lineWidth = 2;
    maze.forEach(function(wall) {
        ctx.beginPath();
        ctx.moveTo(wall[0], wall[1]);
        ctx.lineTo(wall[0] + wall[2], wall[1] + wall[3]);
        ctx.stroke();
    });

    var witchImg = new Image();
    witchImg.src = '../image/Witch.png';
    witchImg.onload = function() {
        ctx.drawImage(witchImg, witchX, witchY, witchWidth, witchHeight);
    };

    var chestImg = new Image();
    chestImg.src = '../image/Treasure Chest.png';

    chestImg.onload = function() {
        chestPositions.forEach(function(pos, index) {
            if (index + 1 > currentQuestionIndex
            ) {
                ctx.filter = 'grayscale(100%)';
                ctx.cursor = 'not-allowed';
            } else {''
                ctx.filter = 'none';
            }
            ctx.drawImage(chestImg, pos[0], pos[1], 30, 30);
            ctx.filter = 'none';
        });
    };

    canvas.onclick = function(event) {
        var rect = canvas.getBoundingClientRect();
        var x = event.clientX - rect.left;
        var y = event.clientY - rect.top;

        chestPositions.forEach(function(pos, index) {
            var chestX = pos[0];
            var chestY = pos[1];
            if (x >= chestX && x <= chestX + 30 && y >= chestY && y <= chestY + 30) {
                if (index + 1 <= currentQuestionIndex) {
                    showChestMessage(index + 1);
                } else {
                    showLockedMessage(index + 1);
                }
            }
        });
    };
}

function checkCollision(x, y) {
    var witchSize = 20;

    return maze.some(function(wall) {
        var wallX = wall[0];
        var wallY = wall[1];
        var wallWidth = wall[2];
        var wallHeight = wall[3];

        return (
            x < wallX + wallWidth &&
            x + witchSize > wallX &&
            y < wallY + wallHeight &&
            y + witchSize > wallY
        );
    });
}

function checkChestCollision(witchX, witchY) {
    for (var i = 0; i < chestPositions.length; i++) {
        var chestX = chestPositions[i][0];
        var chestY = chestPositions[i][1];
        
        if (
            Math.abs(witchX - chestX) <= 30 &&
            Math.abs(witchY - chestY) <= 30
        ) {
            return i + 1; 
        }
    }
    
    return 0; 
}

function moveWitch(direction) {
    var speed = 5;
    var nextX = witchX;
    var nextY = witchY;

    switch(direction) {
        case 'up':
            nextY -= speed;
            break;
        case 'down':
            nextY += speed;
            break;
        case 'left':
            nextX -= speed;
            break;
        case 'right':
            nextX += speed;
            break;
    }

    if (!checkCollision(nextX, nextY)) {
        witchX = nextX;
        witchY = nextY;
        
        var chestNumber = checkChestCollision(witchX, witchY);
        if (chestNumber > 0) {
            showChestMessage(chestNumber);
        }

        drawMaze();
    }
}

document.addEventListener('keydown', function(event) {
    switch(event.key) {
        case 'ArrowUp':
            moveWitch('up');
            break;
        case 'ArrowDown':
            moveWitch('down');
            break;
        case 'ArrowLeft':
            moveWitch('left');
            break;
        case 'ArrowRight':
            moveWitch('right');
            break;
    }
});

window.onload = function() {
    currentQuestionIndex = parseInt(document.getElementById('currentSection').textContent);
    timeLeft = parseInt(document.getElementById('timer').textContent.split(':')[0]) * 60 + 
               parseInt(document.getElementById('timer').textContent.split(':')[1]);
    startTimer();
    drawMaze();

     if (document.querySelector('.message')) {
        document.getElementById('question-container').style.display = 'block';
    }
};