document.querySelector("#add_comment").addEventListener("click", function() {
    let text = document.querySelector("#text").value;
    let url = new URL(location.href);
    let photo_id = url.searchParams.get("photo_id");

    fetch("add_comment.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: new URLSearchParams({
            text: text,
            photo_id: photo_id
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            let comment = data.comment;
            let commentSection = document.querySelector("#comments_section");
            let newComment = document.createElement("div");
            newComment.classList.add("comment");
            newComment.innerHTML = `
                <p><strong>${comment.Name}</strong></p>
                <p>${comment.Text}</p>
                <p><small>${comment.PoS_date}</small></p>
            `;
            commentSection.prepend(newComment);
        } else {
            console.error("Failed to add comment:", data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});

let headerButton = document.querySelector(".icon");
headerButton.addEventListener("click", function() {
    let header = document.querySelector("header");
    if (header.classList.contains("open")) {
        closeTango();
    } else {
        header.classList.add("open");
        document.querySelector(".Tango").style.display = "flex";
    }
});

function closeTango() {
    let header = document.querySelector("header");
    header.classList.remove("open");
    document.querySelector(".Tango").style.display = "none";
}
