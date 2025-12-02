import { SearchResult } from "./component/SearchResult.js";

document.addEventListener("DOMContentLoaded", () => {
    customElements.define("custom-searchresult", SearchResult);
});