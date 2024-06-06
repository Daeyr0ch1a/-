
let headerButton = document.querySelector(".icon");
headerButton.addEventListener("click", function() {
    let header = document.querySelector("header");
    if (header.classList.contains("open")) {
        closeTango();
    } else {
        header.classList.add("open");
        document.querySelector(".icon img").src = "close.png";
    }
});

function closeTango() {
    let header = document.querySelector("header");
    header.classList.remove("open");
    document.querySelector(".icon img").src = "icons.png";
}

document.querySelector("#D").addEventListener("click", closeTango, false);
document.querySelector("header .Tango").addEventListener("click", closeTango, false);

document.querySelector("#ADDPhoto").addEventListener("click", function() {
    document.querySelector("#Pain").classList.add("open");
});

document.querySelector("#close").addEventListener("click", function(e) {
    e.preventDefautlt();
    document.querySelector("#Pain").classList.remove("open");
});

document.querySelector("#natural").addEventListener("click", function() {
    let src = document.querySelector("#newP_src").value;
    let text = document.querySelector("#newT_text").value || "Стандарт";
    if (src) {
        let tangoP = document.querySelector("#TangoP");
        let img = tangoP.querySelector("img");
        let p = tangoP.querySelector("p");

        img.src = src;
        p.textContent = text;

        let firstPhoto = document.querySelector(".photo");
        if (firstPhoto) {
            document.querySelector("#D").insertBefore(tangoP, firstPhoto);
        } else {
            document.querySelector("#D").appendChild(tangoP);
        }

        tangoP.style.display = "grid";

        document.querySelector("#Pain").classList.remove("open");
        document.querySelector("#newP_src").value = "";
        document.querySelector("#newT_text").value = "";
    } else {
        alert("Введите ссылку на картинку.");
    }
});

function enlargeImage(element) {
    element.addEventListener("click", function(event) {
        event.stopPropagation();
        let enlargedPhoto = document.createElement("div");
        enlargedPhoto.classList.add("enlarged-photo");

        let clonedImg = this.cloneNode(true);
        enlargedPhoto.appendChild(clonedImg);

        document.body.appendChild(enlargedPhoto);

        enlargedPhoto.addEventListener("click", function() {
            document.body.removeChild(enlargedPhoto);
        });
    });
}

document.querySelectorAll(".photo img").forEach(img => {
    enlargeImage(img);
});


let tangoP = document.querySelector("#TangoP");
enlargeImage(tangoP);
