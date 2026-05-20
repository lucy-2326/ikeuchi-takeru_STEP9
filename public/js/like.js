console.log('like.js loaded');

document.addEventListener('DOMContentLoaded', function () {
  const forms = document.querySelectorAll('.like-form');

  forms.forEach(function (form) {
    form.addEventListener('submit', function (event) {

      event.preventDefault();

      fetch(form.action, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
          'Accept': 'application/json'
        }
      })
        .then(response => response.json())
        .then(data => {
          const heart = form.querySelector('.like-heart');

          if (data.liked) {
            heart.textContent = '♥';
            heart.style.color = 'red';
          } else {
            heart.textContent = '♡';
            heart.style.color = 'black';
          }
        });
    });
  });
});
