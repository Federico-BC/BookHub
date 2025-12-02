export class SearchResult extends HTMLElement {
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

        let bookTitle = data.title ?? "Título no disponible";
        let bookAuthor = data.by_statement ?? "Autor no disponible";

        response = await fetch(`https://openlibrary.org/api/books?format=json&bibkeys=OLID:${olid}`)
        data = await response.json();

        let smallThumb = data[`OLID:${olid}`]?.thumbnail_url;

        let thumbnailUrl = smallThumb.substring(0, smallThumb.length - 5) + "M.jpg";

        let container = document.createElement("div");
        container.className = "card mb-4 shadow-sm p-3";

        container.innerHTML = `
            <div class="row g-3 align-items-center">

                <div class="col-3 col-md-2">
                    <div class="book-img-wrapper">
                        <img src="${thumbnailUrl}" class="img-fluid rounded" alt="Portada del libro">
                    </div>
                </div>

                <div class="col-9 col-md-10">
                    <h5 class="book-title mb-1">
                        <a href="/book/${olid}"
                           style="color: black; text-decoration: none;">
                           ${bookTitle}
                        </a>
                    </h5>

                    <p class="text-muted mb-0">
                        ${bookAuthor}
                    </p>
                </div>

            </div>
        `;

        loadingText.remove();
        this.append(container);
    }
}