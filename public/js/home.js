import { BookCard } from "./component/bookCard.js";

document.addEventListener("DOMContentLoaded", () => {
    customElements.define("custom-bookcard", BookCard);
});