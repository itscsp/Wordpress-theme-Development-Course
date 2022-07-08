import $ from 'jquery';

class MyNotes {
    constructor() {
        this.events();
    }

    events() {
        $('.delete-note').on("click", this.deleteNote);
        $('.edit-note').on("click", this.editNote);
    }

    //methods will go here
    deleteNote() {
        $.ajax({

            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', univercityData.nonce)
            },

            url:univercityData.root_url+'/wp-json/wp/v2/note/109',
            type:'DELETE',
            success: (response) => {
                console.log('Congrats')
                console.log(response)
            },
            error: (response) => {
                console.log('Soory')
                console.log(response)
            }
        })
    }

    editNote() {
        alert('You clicked edit');
    }

}

export default MyNotes;