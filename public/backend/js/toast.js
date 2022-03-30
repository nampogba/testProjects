function toast({title = '',
    message = '',
    type = info,
    duration = 3000,
    }) {
        const main = document.getElementById('toast');
        if(main){
            //Tạo div element
            const toast = document.createElement('div');

            //automatic remove
            const autoRemove = setTimeout(() => {
                main.removeChild(toast);
            }, duration + 1000)

            //click remove
            toast.onclick = function(e){
                if(e.target.closest('.toast__close')){
                     main.removeChild(toast);
                     clearTimeout(autoRemove);
                }
            };

            //list icon
            const icons = {
                success: "fas fa-check-circle",
                info: "fas fa-info-circle",
                warning: "fas fa-exclamation-circle",
                error: "fas fa-exclamation-circle"
            };
            const icon = icons[type]; //lấy icon tương ứng
            const delay = (duration / 1000).toFixed(2); //lấy thời gian delay
            toast.classList.add('toast', `toast--${type}`); // add class vào thẻ div
            toast.style.animation = `slideInLeft ease .3s, fadeOut linear 1s ${delay}s forwards`; //set animation cho toast

            //Thêm các element con của toast
            toast.innerHTML = `
            <div class="toast__icon">
                <i class="${icon}"></i>
            </div>
            <div class="toast__body">
                <h3 class="toast__title">${title}</h3>
                    <p class="toast__msg">${message}</p>
                </div>
            <div class="toast__close">
                <i class="fas fa-times"></i>
            </div>`;

            //add toast vào id toast
            main.appendChild(toast);
        }
    }