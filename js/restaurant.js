
/********** STAR RATING *********/
var numStars = 0; // the selected # of stars, changes w/ click

// Buttons
var star1 = document.getElementById("str1");
var star2 = document.getElementById("str2");
var star3 = document.getElementById("str3");
var star4 = document.getElementById("str4");
var star5 = document.getElementById("str5");

// Labels (stars)
var star1_label = document.getElementById("str1-label");
var star2_label = document.getElementById("str2-label");
var star3_label = document.getElementById("str3-label");
var star4_label = document.getElementById("str4-label");
var star5_label = document.getElementById("str5-label");

/* Helper functions: set orange or gray color of stars */
function s0() {
    star1_label.style.color = "gray";
    star2_label.style.color = "gray";
    star3_label.style.color = "gray";
    star4_label.style.color = "gray";
    star5_label.style.color = "gray";
}
function s1() {
    s0(); star1_label.style.color = "orange";
}
function s2() {
    s1(); star2_label.style.color = "orange";
}
function s3() {
    s2(); star3_label.style.color = "orange";
}
function s4() {
    s3(); star4_label.style.color = "orange";
}
function s5() {
    s4(); star5_label.style.color = "orange";
}

function setToNumStars() { // sets stars to selected # of stars
    // switch statement https://www.w3schools.com/js/js_switch.asp
    switch (numStars) {
        case 0:
            s0(); break;
        case 1:
            s1(); break;
        case 2:
            s2(); break;
        case 3:
            s3(); break;
        case 4:
            s4(); break;
        case 5:
            s5(); break;
    }
}

// Change color when user hovers over star 
function hoverStar(hover_id) {
    switch (hover_id) {
        case "str1":
            s1(); break;
        case "str2":
            s2(); break;
        case "str3":
            s3(); break;
        case "str4":
            s4(); break;
        case "str5":
            s5(); break;
    }
}

// Add event listeners 
// Passing arguments to a function listed in an addEventListener function: https://stackoverflow.com/questions/256754/how-to-pass-arguments-to-addeventlistener-listener-function 
// Event listener for button: mouseover 
star1.addEventListener('mouseover', function () {
    hoverStar(this.id);
}, false);
star2.addEventListener('mouseover', function () {
    hoverStar(this.id);
}, false);
star3.addEventListener('mouseover', function () {
    hoverStar(this.id);
}, false);
star4.addEventListener('mouseover', function () {
    hoverStar(this.id);
}, false);
star5.addEventListener('mouseover', function () {
    hoverStar(this.id);
}, false);

// When mouseout, change the orange/black color to the selected # of stars
// Event listener for button: mouseout 
star1.addEventListener('mouseout', setToNumStars, false);
star2.addEventListener('mouseout', setToNumStars, false);
star3.addEventListener('mouseout', setToNumStars, false);
star4.addEventListener('mouseout', setToNumStars, false);
star5.addEventListener('mouseout', setToNumStars, false);

// Event listener for label/star: mouseover
star1_label.addEventListener('mouseover', function () {
    hoverStar(this.id);
}, false);
star2_label.addEventListener('mouseover', function () {
    hoverStar(this.id);
}, false);
star3_label.addEventListener('mouseover', function () {
    hoverStar(this.id);
}, false);
star4_label.addEventListener('mouseover', function () {
    hoverStar(this.id);
}, false);
star5_label.addEventListener('mouseover', function () {
    hoverStar(this.id);
}, false);

// Event listener for label: mouseout 
star1_label.addEventListener('mouseout', setToNumStars, false);
star2_label.addEventListener('mouseout', setToNumStars, false);
star3_label.addEventListener('mouseout', setToNumStars, false);
star4_label.addEventListener('mouseout', setToNumStars, false);
star5_label.addEventListener('mouseout', setToNumStars, false);

/* Select Star*/
function selectStar(clicked_id) { // called when the user clicks on a star 
    switch (clicked_id) {
        case "str1":
            numStars = 1; break;
        case "str2":
            numStars = 2; break;
        case "str3":
            numStars = 3; break;
        case "str4":
            numStars = 4; break;
        case "str5":
            numStars = 5; break;
    }
}

/****** LEAVING A REVIEW ******/
function validateReview() {
    var msg = document.getElementById("review-msg");
    var star_msg = document.getElementById("star-msg");
    var userText = document.getElementById("review").value;
    if (userText == "") {
        msg.textContent = 'Please enter some text in the box first, then press "Submit."';
        return false;
    } else if (numStars == 0) {
        star_msg.textContent = 'Please select a star to give a rating, then press "Submit."';
        return false;
    } else {
        msg.textContent = "";
        postReview();
        numStars = 0;
        s0();
        return false;
    }
}

/* Average restaurant rating */
var avgRating = 4.5; // dummy value 
avgResRating = document.getElementById("avgResRating");

// var percentRating = (avgRating / 5.0) * 105.0 + "px";

//Arrow function
const percent = (x) =>(x/5.0) * 105.0 + "px";
var percentRating = percent(avgRating);

avgResRating.style.width = percentRating;


//Anonymous function
var avg = function(a) { return (4.5 + a)/2.0};

function postReview() // User posts review 
{
    var userText = document.getElementById("review").value;
    var cardDiv = document.getElementById("reviewCards");
    var msg = document.getElementById("review-msg");
    cardDiv.innerHTML += `<div class='card'> 
                                        <div class='card-body'> 
                                            <p class="ratingReview">` + formatStarsReview(numStars) + `</p>
                                            <p>` + userText + `</p> 
                                        </div> 
                                        </div> 
                                    <br>`;
    document.getElementById("review").value = "";
    msg.textContent = "Thanks! Your review has been submitted.";
    // avgRating = (4.5 + numStars) / 2.0;

    avgRating = avg(numStars);

    percentRating = percent(avgRating);
    avgResRating.style.width = percentRating;
}

function formatStarsReview(starNum) {
    var ret = `<span class="checked">★</span>`;
    for (var i = 1; i < starNum; i++) {
        ret += `<span class="checked">★</span>`;
    }
    for (var j = 0; j < (5 - starNum); j++) {
        ret += `<span class="unchecked">★</span>`;
    }
    return ret;
}

