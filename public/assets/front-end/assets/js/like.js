
document.addEventListener('DOMContentLoaded', function () {
    const containers = document.querySelectorAll('.like-dislike-container');

    containers.forEach(container => {
        let likeCount = 0;
        let dislikeCount = 0;

        const likeBtn = container.querySelector('.likes-btn');
        const dislikeBtn = container.querySelector('.dislike-btn');
        const likeCountSpan = container.querySelector('.like-count');
        const dislikeCountSpan = container.querySelector('.dislike-count');

        likeBtn.addEventListener('click', function () {
            if (!likeBtn.classList.contains('liked')) {
                likeCount++;
                likeBtn.classList.add('liked');

                // Remove dislike count and style if disliked before
                dislikeCount = 0;
                dislikeBtn.classList.remove('disliked');
            } else {
                likeCount--;
                likeBtn.classList.remove('liked');
            }

            likeCountSpan.textContent = likeCount;
            dislikeCountSpan.textContent = dislikeCount;
        });

        dislikeBtn.addEventListener('click', function () {
            if (!dislikeBtn.classList.contains('disliked')) {
                dislikeCount++;
                dislikeBtn.classList.add('disliked');

                // Remove like count and style if liked before
                likeCount = 0;
                likeBtn.classList.remove('liked');
            } else {
                dislikeCount--;
                dislikeBtn.classList.remove('disliked');
            }

            likeCountSpan.textContent = likeCount;
            dislikeCountSpan.textContent = dislikeCount;
        });
    });
});