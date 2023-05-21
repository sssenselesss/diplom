const BurgerMenu = () => {
    const parent = document.querySelector('.burger-block');
    if (!parent) return false

    const burgerButton = parent.querySelector('.burger');

    const burgerMenu = parent.querySelector('.burger-menu');

    burgerButton.addEventListener('click', () => {
        burgerMenu.classList.toggle('active');
    })
}

const Accordeon = () => {
    const parent = document.querySelector('.questionsFreq');
    if (!parent) return false

    const questions = parent.querySelectorAll('.question');

    questions.forEach((item) => {
        const arrow = item.querySelector('.arrow');
        const content = item.querySelector('.question-content')
        const container = item.querySelector('.question-container')

        arrow.addEventListener('click', () => {
            content.classList.toggle('active');
            arrow.classList.toggle('active')
            container.classList.toggle('active')
        })
    })

}

const currentLengthFeedback = () => {
    const parent = document.querySelector('.modal-order');
    if (!parent) return false

    const textArea = parent.querySelector('.modal-order__textarea');
    const currentLength = parent.querySelector('.currentLengt');


    textArea.addEventListener('keydown', (e) => {
        let a = e.currentTarget.value.length
        currentLength.textContent = a

    })
}

const modalOrder = () => {
    const parent = document.querySelector('.modal-order');
    if (!parent) return false

    const taskId = parent.querySelector('.task_id')
    const executorId = parent.querySelector('.executor_id')
    const customerId = parent.querySelector('.customer_id')
    const orderId = parent.querySelector('.order_id')


    const showModal = document.querySelectorAll('.orderChangeStatus');

    document.addEventListener('keydown', (e) => {
        if (e.which === 27) {
            close();
        }
    })

    const closeModal = parent.querySelector('.modal-close');

    const close = () => parent.classList.remove('active');
    const show = () => parent.classList.add('active');

    showModal.forEach((item) => {


        item.addEventListener('click', ()=>{
            show()
            taskId.setAttribute('value',item.parentNode.parentNode.parentNode.dataset.taskId)
            executorId.setAttribute('value',item.parentNode.parentNode.parentNode.dataset.exeId)
            customerId.setAttribute('value',item.parentNode.parentNode.parentNode.dataset.custId)
            orderId.setAttribute('value',item.parentNode.parentNode.parentNode.dataset.orderId)

        })
    })


    closeModal.addEventListener('click', close)

    window.addEventListener('load',()=>{
        if(parent.querySelector('.danger-log')){
            show();
        }
    })
}

const ModalCategory = () => {
    const parent = document.querySelector('.catalog-items');
    if (!parent) return false

    const modalWindow = parent.querySelector('.categories-modal');
    const showCategory = parent.querySelector('.category-modal__button');

    const burgerMenu = parent.querySelector('.categories-modal');


    document.addEventListener('keydown', (e) => {
        if (e.which === 27) {
            close();
        }
    })


    const close = () => burgerMenu.classList.remove('active');
    const show = () => burgerMenu.classList.add('active');
    modalWindow.addEventListener('click', (e)=>e.target === modalWindow && close());
    showCategory.addEventListener('click', show);



}

const attachFile = () => {

    const parent = document.querySelector('.attach')
    console.log(parent)
    if (!parent) return false

    const attachDiv = document.querySelector('.file-attach');
    const attachFileInput = document.querySelector('.addArtilce__input');

    attachDiv.addEventListener('click', () => {
        attachFileInput.click();
    })
}

const currentLengthDiscription = () => {
    const parent = document.querySelector('.addArticle');
    if (!parent) return false


    const textArea = parent.querySelector('.addArticle__text');
    if(!textArea) return false

    const currentLength = parent.querySelector('.currentLengt');

    textArea.addEventListener('keydown', (e) => {
        let a = e.currentTarget.value.length
        currentLength.textContent = a

    })
}
const currentLengthOther = () => {
    const parent = document.querySelector('.addArticle');
    if (!parent) return false

    const textArea = parent.querySelector('.Othertext');
    if(!textArea) return false

    const currentLength = parent.querySelector('.otherLength');


    textArea.addEventListener('keydown', (e) => {
        let a = e.currentTarget.value.length
        currentLength.textContent = a

    })
}

const modalLogin = () => {
    const modal = document.querySelector('.login-modal');
    if(!modal) return false

    const modalReg = document.querySelector('.registration-modal');

    const showLogin = modalReg.querySelector('.loginFromReg');

    const showModal = document.querySelector('.modal-open__login');
    const showModalBurger = document.querySelector('.openModal__burger');

    const closeModal = modal.querySelector('.modal-close');

    showLogin.addEventListener('click',()=>{
        show();
        modalReg.classList.remove('active')
    })

    const close = () => modal.classList.remove('active');
    const show = () => modal.classList.add('active');

    showModal.addEventListener('click', show);
    showModalBurger.addEventListener('click', show);
    closeModal.addEventListener('click',close)

    document.addEventListener('keydown', (e) => {
        if (e.which === 27) {
            close();
        }
    })

    modal.addEventListener('click', (e) => e.target === modal && close());

    window.addEventListener('load',()=>{
        if(modal.querySelector('.danger-log')){
            show();
        }
    })
}

const modalRegistrtion = () => {
    const modal = document.querySelector('.registration-modal');
    if(!modal) return false

    const modalLogin = document.querySelector('.login-modal');

    const showReg = modalLogin.querySelector('.regFromLogin');

    const closeModal = modal.querySelector('.modal-close');


    const close = () => modal.classList.remove('active');
    const show = () => modal.classList.add('active');

    showReg.addEventListener('click',()=>{
        show();
        modalLogin.classList.remove('active')
    });


    closeModal.addEventListener('click',close)

    document.addEventListener('keydown', (e) => {
        if (e.which === 27) {
            close();
        }
    })
    modal.addEventListener('click', (e) => e.target === modal && close());

    window.addEventListener('load',()=>{
        if(modal.querySelector('.danger')){
            show();
        }
    })
}

const alertTimeout = () =>{
    setTimeout(function(){
        document.getElementById('alert').style.display = 'none';
    }, 3000);

}

const modalAddCategory = () =>{
    const parent = document.querySelector('.allCategories')
  if(!parent) return false

    const modal = parent.querySelector('.addCategory-modal');

  const showModal = parent.querySelector('.add-category__modal-open');
const closeModal = modal.querySelector('.modal-close');
    console.log(showModal)
    const close = () => modal.classList.remove('active');
    const show = () => modal.classList.add('active');

    showModal.addEventListener('click',show);
    closeModal.addEventListener('click',close);

    document.addEventListener('keydown', (e) => {
        if (e.which === 27) {
            close();
        }
    })
    modal.addEventListener('click', (e) => e.target === modal && close());

    window.addEventListener('load',()=>{
        if(modal.querySelector('.danger')){
            show();
        }
    })
}

const modal = () =>{

    const modal = document.querySelector('.modal');

    if(!modal) return false

    const showModal = document.querySelector('.open_modal_comp');
    const closeModal = modal.querySelector('.modal-close');

    const show = ()=>modal.classList.add('active');
    const close = ()=>modal.classList.remove('active');

    showModal.addEventListener('click', show);
    closeModal.addEventListener('click',close);

    document.addEventListener('keydown', (e) => {
        if (e.which === 27) {
            close();
        }
    })
    modal.addEventListener('click', (e) => e.target === modal && close());

    window.addEventListener('load',()=>{
        if(modal.querySelector('.danger')){
            show();
        }
    })
}










const init = () => {
    BurgerMenu();
    Accordeon();
    currentLengthFeedback()
    currentLengthDiscription()
    currentLengthOther()
    modalOrder()
    attachFile()
    ModalCategory()
    modalLogin();
    modalRegistrtion()
    alertTimeout()
    modalAddCategory()
    modal()
}

document.addEventListener('DOMContentLoaded', init)
