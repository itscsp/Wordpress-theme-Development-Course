import $ from "jquery"

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.resultDiv = $("#search-overlay__results")
    this.openButton = $(".js-search-trigger")
    this.closeButton = $(".search-overlay__close")
    this.searchOverlay = $(".search-overlay")
    this.searchField = $("#search-term")
    this.events()
    this.isOverlayOpen = false;
    this.typingTimer;
    this.isSpinnerVisible = false;
    this.previousValue;

  }

  // 2. events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this))
    this.closeButton.on("click", this.closeOverlay.bind(this))
    $(document).on("keydown", this.keyPressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }

  // 3. methods (function, action...)
  typingLogic() {
    if(this.searchField.val() != this.previousValue){
        clearTimeout(this.typingTimer);
        if(this.searchField.val()){

            if(!this.isSpinnerVisible) {
                this.resultDiv.html('<div class="spinner-loader"></div>')
                this.isSpinnerVisible = true;
            }
            this.typingTimer = setTimeout(this.getResult.bind(this), 2000)

        }else{
            this.resultDiv.html('');
            this.isSpinnerVisible = false;
        }

    }


    this.previousValue = this.searchField.val();
  }

  getResult() {
    $.getJSON(univercityData.root_url+'/wp-json/wp/v2/posts?search='+this.searchField.val(), posts => {


        this.resultDiv.html(`
          <h2 class="search-overlay__section-title" >General Information</h2>
          ${posts.length ?
          `<ul>
            ${posts.map(item => `
            <li>
              <a href="${item.link}">${item.title.rendered}</a>
            </li>
            `).join('')}
          </ul>`
           :
          `<p>No general information matches that search.</p>`
          }
          `);
          this.isSpinnerVisible = false;

    })


  }

  keyPressDispatcher(e) {

    if(e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {
        this.openOverlay();
    }

    if(e.keyCode == 27 && this.isOverlayOpen){
        this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active")
    this.isOverlayOpen = true;
    this.searchField.focus();
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active")

    this.isOverlayOpen = false;
  }

  searchText() {

  }
}

export default Search
