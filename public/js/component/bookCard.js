export class BookCard extends HTMLElement {
    constructor() {
        super();
    }

    async connectedCallback() {
        let olid = this.getAttribute("olid");

        let loadingText = document.createElement("p");
        loadingText.innerText = "Cargando...";
        this.append(loadingText);

        let response = await fetch(`https://openlibrary.org/books/${olid}.json`);

        let data = await response.json();

        let bookTitle = data["title"];

        response = await fetch(`https://openlibrary.org/api/books?format=json&bibkeys=OLID:${olid}`);

        data = await response.json();

        let smallThumnailUrl = data[`OLID:${olid}`]["thumbnail_url"];

        let thumbnailUrl = smallThumnailUrl.substring(0, smallThumnailUrl.length - 5) + "M.jpg";

        let primaryDiv = document.createElement("div");
        primaryDiv.className = "card";
        primaryDiv.style.width = "15rem";
        primaryDiv.style.height = "390px";

        let img = document.createElement("img");
        img.src = thumbnailUrl;
        img.className = "card-img-top w-75 rounded mx-auto d-block mt-4";
        img.alt = "Portada de libro";
        primaryDiv.append(img);

        let cardBody = document.createElement("div");
        cardBody.className = "card-body";
        primaryDiv.append(cardBody);

        let cardTitle = document.createElement("h5");
        cardTitle.className = "card-title";
        cardTitle.innerText = bookTitle;
        cardBody.append(cardTitle);

        loadingText.remove();

        this.append(primaryDiv);
        this.addEventListener("click", () => {
            window.location.href = `/book/${olid}`;
        })
    }
}