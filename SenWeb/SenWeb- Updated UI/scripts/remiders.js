
const a = new Date();
a.setDate(a.getDate() - 2);
document.getElementById("one").innerHTML = a.getDate();

const b = new Date();
b.setDate(b.getDate() - 1);
document.getElementById("two").innerHTML = b.getDate();

const c = new Date();
document.getElementById("three").innerHTML = c.getDate();

const d = new Date();
d.setDate(d.getDate() + 1);
document.getElementById("four").innerHTML = d.getDate();

const e = new Date();
e.setDate(e.getDate() + 2);
document.getElementById("five").innerHTML = e.getDate();

function myFunction() {
    //   var x = document.createElement("BUTTON");
    //   var t = document.createTextNode("Click me");
    //   x.appendChild(t);
    //   document.body.appendChild(x);
    let text;
    let reminder = prompt("Which Reminder?\n1.Meal \n2.Medicine \n3.Other", "Meal");
    switch(reminder) {
        case "Meal":
        text = "Excellent choice. Coca-Cola is good for your soul";
        break;
        case "meal":
        text = "Excellent choice. ";
        break;
        case "Medicine":
        text = "Pepsi is my favorite too!";
        break;
        case "medicine":
        text = "Pepsi is my favorite too!";
        break;
        case "Other":
        text = "Really? Are you sure the Sprite is your favorite?";
        break;
        case "other":
        text = "Really? Are you sure the Sprite is your favorite?";
        break;
        default:
        text = "Oops...";
    }
    document.getElementById("main").innerHTML = text;

    }