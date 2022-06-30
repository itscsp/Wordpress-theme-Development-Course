import $ from "jquery"

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.addSearchHTML();
    this.resultDiv = $("#search-overlay__results")
    this.openButton = $(".js-search-trigger")
    this.closeButton = $(".search-overlay__close")
    this.searchOverlay = $(".search-overlay")
    this.searchField = $("#search-term")
    this.events();
    this.isOverlayOpen = false;
    this.typingTimer;
    this.isSpinnerVisible = false;
    this.previousValue;

  }

  // 2. events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
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
            this.typingTimer = setTimeout(this.getResult.bind(this), 500)

        }else{
            this.resultDiv.html('');
            this.isSpinnerVisible = false;
        }

    }

    this.previousValue = this.searchField.val();
  }

  getResult() {
    $.getJSON(univercityData.root_url+'/wp-json/university/v1/search?term='+this.searchField.val()), (result) => {

      this.resultDiv.html(`
        <div class="row">
          <div className="one-third">
            <h2 className="search-overlay__section-title">General Information</h2>

            ${result.generalInfo.length ?
              `<ul class="link-list min-list">
                ${result.generalInfo.map(item => `
                <li>
                  <a href="${item.permlink}">${item.title}</a>
                </li>
                `).join('')}
              </ul>`
                :
              `<p>No general information matches that search.</p>`
              }

          </div>

          <div className="one-third">
            <h2 className="search-overlay__section-title">Programs</h2>

            <h2 className="search-overlay__section-title">Professors</h2>
          </div>

          <div className="one-third">
            <h2 className="search-overlay__section-title">Campuses</h2>

            <h2 className="search-overlay__section-title">Events</h2>
          </div>

        </div>
      `);
    }
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
    this.searchField.val('');
    this.isOverlayOpen = true;
    /*Notes
    Here one point to cear why i add focus function inside timeout function becouse
    when opening search overlay it not open immediately it takes some time so we wait until it open up correctly
    then we add focus to it
    */
    setTimeout(() => {this.searchField.focus()}, 500)

  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active")
    this.isOverlayOpen = false;
  }

  addSearchHTML() {
    $("body").append(`

    <div class="search-overlay">
      <div class="search-overlay__top">
        <div class="container">
          <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
          <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term" autofocus>
          <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
        </div>
      </div>

      <div class="container">
        <div id="search-overlay__results">

        </div>
      </div>

    </div>
    `);
  }


}

export default Search
