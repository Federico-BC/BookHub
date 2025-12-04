export class ProfileBookCard extends HTMLElement {
    constructor() {
        super();
    }

    async connectedCallback() {
        let olid = this.getAttribute("olid");

        this.className = "col-6 col-md-3 col-lg-2";
        this.style.cursor = "pointer";

        let loadingText = document.createElement("p");
        loadingText.className = "small text-muted text-center";
        loadingText.innerText = "Cargando...";
        this.append(loadingText);

        try {
            let response = await fetch(`https://openlibrary.org/books/${olid}.json`);
            let data = await response.json();
            let bookTitle = data.title ?? "Título no disponible";

            response = await fetch(`https://openlibrary.org/api/books?format=json&bibkeys=OLID:${olid}`)
            data = await response.json();

            let smallThumb = data[`OLID:${olid}`]?.thumbnail_url;
            let thumbnailUrl = smallThumb.replace(/S\.jpg$/, 'M.jpg');

            this.innerHTML = `
                <div class="text-center">
                    <img src="${thumbnailUrl}" 
                         class="img-fluid book-cover" 
                         alt="Portada de ${bookTitle}">
                    <p class="small book-title">
                        ${bookTitle}
                    </p>
                </div>
            `;
            
            this.addEventListener("click", () => {
                window.location.href = `/book/${olid}`;
            });

        } catch (error) {
            console.error(`Error al cargar el libro ${olid}:`, error);
            this.innerHTML = `<p class="small text-danger text-center">Error al cargar.</p>`;
        } finally {
            if (this.contains(loadingText)) {
                loadingText.remove();
            }
        }
    }
}

customElements.define("custom-profilebookcard", ProfileBookCard);