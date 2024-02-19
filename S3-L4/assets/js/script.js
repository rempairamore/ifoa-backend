const urlSito = 'https://justatip.it/wp-json/wp/v2/'


async function salvaPosts() {
    await fetch(urlSito+'posts/?page=2')
    .then(response => response.json())
    .then(json => creazioneIndex(JSON.stringify(json)))
}

function creazioneIndex(nuoviPosts) {
    localStorage.setItem('posts', nuoviPosts);
    const posts = JSON.parse(localStorage.getItem('posts'));
    console.log(posts);

    let spazioPosts = document.querySelector('#spazioPosts');
    
    posts.forEach(post => {

        let nuovoFiglio = document.createElement('div');
        nuovoFiglio.className = 'col';
        nuovoFiglio.innerHTML = `
            <div class="card h-100">
            <img src="${post.jetpack_featured_media_url}" class="card-img-top" alt="immagine card">
            <div class="card-body">
            <h5 class="card-title">${post.title.rendered}</h5>
            <p class="card-text">${post.excerpt.rendered}</p>
            </div>
        </div>
        `

        spazioPosts.appendChild(nuovoFiglio);
        
    });

    
}



// Cosa succede se vado nella home page 
if(document.location.pathname === '/index.html' || document.location.pathname === '/') {
    salvaPosts();
}




