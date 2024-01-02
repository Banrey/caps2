
const postBtn = document.getElementById('BtnPost')
const commentBtn = document.getElementById('BtnComment')
var comCont = document.getElementById( 'comment_container' )


commentBtn.addEventListener('click', addComment)
postBtn.addEventListener('click', addPost)

function addComment(){   
    const div = document.createElement('div')
    // add class
    div.classList = 'card col-12 px-auto'

    // add html
    div.innerHTML = `
            <div class="card-header">
                <p>Title</p>
                <div style="height: 100px;"class="card-body">
                    <p>Content</p>   
                </div>
            </div>
    `
    // insert feedback into the list
    comCont.insertAdjacentElement('beforeend', div)
}


