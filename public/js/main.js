function burger_menu() {
    const btn_burger = document.getElementById('btn_burger');
    const menu_body = document.querySelector('header .mob_menu');

    btn_burger.addEventListener('click', () => {
        btn_burger.classList.toggle('active');
        menu_body.classList.toggle('active');
    })

}
burger_menu();


function filter_menu() {
    const btn_burger = document.getElementById('btn_filter');
    const menu_body = document.querySelector('.body_filter');

    btn_burger.addEventListener('click', () => {
        btn_burger.classList.toggle('active');
        menu_body.classList.toggle('active');
    })

}



let location_body_btns = document.querySelectorAll('.location_body .toggle_btn')

location_body_btns.forEach(btn => {
    btn.addEventListener('click', () => {
        // hideAlllocation_body()
        btn.classList.toggle('active');
        let hideToggle = btn.parentElement.querySelector('.hide_toggle')
        hideToggle.classList.toggle('show');
    })
});




function openModalToggle() {
    document.querySelector('.modal_thank_you').classList.toggle('active');

}


function modalStoriesActive(n) {
    document.querySelector('.modal_stories').classList.add('active')
    swiper.slideTo(n);
    let video = swiper.slides[n].querySelector('video')
    if (video) {
        video.play();
    }
}
function modalStoriesClose() {
    let videos = document.querySelectorAll('.img_story');
    videos.forEach(function (video) {
        video.pause();
    });
    document.querySelector('.modal_stories').classList.remove('active')
}


let input_search_main_page = document.getElementById('search_main_page');
let body_search_result = document.querySelector('.body_search_result')

if (input_search_main_page) {
    input_search_main_page.addEventListener('input', async (e) => {
        if (input_search_main_page.value.length > 2) {
            let response = await getSearchBlogResult(input_search_main_page.value)
            if (response.length > 0) {
                body_search_result.classList.add('active')
                body_search_result.innerHTML = ''
                response.forEach(element => {
                    body_search_result.innerHTML += "<a href='/blog/" + element.id + "' class='result_item'>" + element.title + "</a>"
                });
            }
            else {
                body_search_result.classList.remove('active')
            }
        }
        else {
            body_search_result.classList.remove('active')
        }
    })
}

async function getSearchBlogResult(query) {
    // const url = 'https://latvian-stories.smartnwild.com/api/blogs/filter?query=' + query;
    const url = 'https://latvian-stories.smartnwild.com/api/blogs/search?categories=&availabilities=&regions=&query=' + query;
    try {
        const response = await fetch(url);
        if (response.status === 200) {
            const data = await response.json();
            return data;
        } else {
            console.error('error');
            return [];
        }
    } catch (error) {
        console.error('error:', error);
        return [];
    }
}




let input_search_stories_page = document.getElementById('search_stories_page');

if (input_search_stories_page) {
    input_search_stories_page.addEventListener('input', async (e) => {
        if (input_search_stories_page.value.length > 2) {
            let response = await getSearchStoriesResult(input_search_stories_page.value)
            if (response.length > 0) {
                body_search_result.classList.add('active')
                body_search_result.innerHTML = ''
                response.forEach(element => {
                    body_search_result.innerHTML += "<a href='/blog/" + element.id + "' class='result_item'>" + element.title + "</a>"
                });
            }
            else {
                body_search_result.classList.remove('active')
            }
        }
        else {
            body_search_result.classList.remove('active')
        }
    })
}

async function getSearchStoriesResult(query) {
    const url = 'https://latvian-stories.smartnwild.com/api/stories/search?query=' + query;
    try {
        const response = await fetch(url);
        if (response.status === 200) {
            const data = await response.json();
            return data;
        } else {
            console.error('error');
            return [];
        }
    } catch (error) {
        console.error('error:', error);
        return [];
    }
}



// FIlter on blog page
let form_filter = document.getElementById('form_filter');
let categories = [];
let availabilities = [];
let regions = [];
let formValues = {};


// Создаем объект для хранения значений

let formElements = form_filter?.elements;
if (form_filter) {
    form_filter.addEventListener('change', (e) => {
        changeFilterParams();
        getFilterBlogResult()
    })
    document.getElementById('filter_search_query').addEventListener('input', () => {
        changeFilterParams();
        getFilterBlogResult()
    })
}


function changeFilterParams() {
    categories = [];
    availabilities = [];
    regions = [];
    // Перебираем все элементы формы
    for (let i = 0; i < formElements.length; i++) {
        let element = formElements[i];
        if (element.type !== "submit" && element.type !== "button" && element.checked) {
            formValues[element.id] = element.value;
        }
    }
    for (const key in formValues) {
        if (formValues.hasOwnProperty(key)) {
            if (key.startsWith("custom-checkbox_region_")) {
                regions.push(formValues[key]);
            } else if (key.startsWith("custom-checkbox_category_")) {
                categories.push(formValues[key]);
            } else if (key.startsWith("custom-checkbox_availability_")) {
                availabilities.push(formValues[key]);
            }
        }
    }
}



async function getFilterBlogResult() {

    let query = document.getElementById('filter_search_query').value;
    let stringCategories = categories.join(',');
    let stringAvailabilities = availabilities.join(',');
    let stringRegions = regions.join(',');
    console.log('categories= ' + stringCategories);
    console.log('availabilities= ' + stringAvailabilities);
    console.log('stringRegions= ' + stringRegions);

    const url = 'https://latvian-stories.smartnwild.com/api/blogs/search?categories=' + stringCategories + '&availabilities=' + stringAvailabilities + '&regions=' + stringRegions + '&query=' + query;
    try {
        const response = await fetch(url);
        if (response.status === 200) {
            const data = await response.json();
            console.log(data);
            drawCardBlog(data)
        } else {
            console.error('error');
            return [];
        }
    } catch (error) {
        console.error('error:', error);
        drawCardBlog(data)
    }
}



function drawCardBlog(elements) {
    let row_stories = document.getElementById('row_stories');
    row_stories.innerHTML = '';
    elements.forEach(elem => {
        console.log(elem);
        let categories = '';
        let count_categories = 0;
        elem.route.categories.forEach((categor, key) => {
            count_categories++
            if (key > 2) {
                categories += `<div class="item_category">+` + (count_categories - key) + `</div>`
                return
            }
            categories += `<div class="item_category">` + categor.title + `</div>`;
        })
        // debugger
        row_stories.innerHTML += `
        <div class="col-12 col-lg-6">
            <a href="/blog/`+ elem.id + `" class="card_blog">
                <img src="`+ elem.image + `" alt="">
                <div class="title">`+ elem.title + `</div>
                <div class="description">`+ elem.description + `</div>
                <div class="location">`+ elem.route.location + `</div>
                <div class="line"></div>
                <div class="category_wrapper">
                    <div class="category_body">`+ categories + `</div>
                    <div class="arrow"></div>
                </div>
            </a>
        </div>`
    });

}


function CreateAncorBlog() {
    let ArrH1 = document.querySelectorAll('.body_content_article h1');
    let body_content = document.querySelector('.body_table_contents .list_table_contents')
    body_content.innerHTML = ''
    ArrH1.forEach((element, key) => {
        element.id = 'article_h1_' + key;
        body_content.innerHTML += "<li><a href='#" + element.id + "'onclick='handleAnchorClick()'>" + element.textContent + "</a></li>"
    });
}
function handleAnchorClick() {
    this.event.preventDefault();
    var targetId = this.event.target.getAttribute('href').substring(1); // Убираем символ '#'
    var targetElement = document.getElementById(targetId);
    if (targetElement) {
        var targetOffset = targetElement.offsetTop;
        var scrollTo = targetOffset + 100;
        window.scrollTo(0, scrollTo);
    }
}



// Функция, которая будет вызвана, когда элемент входит в видимую область
// function handleIntersection(entries, observer) {
//     entries.forEach(entry => {
//         if (entry.isIntersecting) {
//             // Элемент стал видимым, добавляем класс
//             // setTimeout(() => {
//             hideAlllocation_body()
//             entry.target.querySelector('.toggle_btn').classList.add('active')
//             entry.target.querySelector('.hide_toggle').classList.add('show')
//             document.body.style.overflow = 'hidden';
//             setTimeout(() => {
//                 document.body.style.overflow = 'auto';
//             }, 3000);
//             // }, 2000);

//         } else {
//             // Элемент больше не виден, удаляем класс
//             // entry.target.querySelector('.toggle_btn').classList.remove('active')
//             // entry.target.querySelector('.hide_toggle').classList.remove('show')
//         }
//     });
// }

function hideAlllocation_body() {
    let location_body_btns = document.querySelectorAll('.location_body .toggle_btn')
    let hideToggles = document.querySelectorAll('.location_body .hide_toggle')
    location_body_btns.forEach(btn => {
        btn.classList.remove('active')
    })
    hideToggles.forEach(elem => {
        elem.classList.remove('show')
    })
}


function nameDayScroll() {
    let allDay = document.querySelectorAll('.day_wrapper .day_name');
    allDay.forEach(elem => {
        elem.addEventListener('click', () => {
            // hideAlllocation_body()
            let element_next = elem.nextElementSibling;
            element_next.querySelector('.toggle_btn').classList.add('active')
            element_next.querySelector('.hide_toggle').classList.add('show')
        })
    })
}
nameDayScroll()

// Создаем экземпляр Intersection Observer
// const options = {
//     root: null, // Используем viewport в качестве корневого элемента
//     rootMargin: '0px',
//     threshold: 1, // 0.5 означает, что хотя бы 50% элемента должно быть видимо
// };
// const observer = new IntersectionObserver(handleIntersection, options);

// // Получаем все элементы, которые хотим отслеживать
// const boxes = document.querySelectorAll('.location_body');
// boxes.forEach(box => {
//     observer.observe(box);
// });



let lastScrollTop = 0;
// let scroll_direction = 'null'
let header = document.querySelector('header')
window.addEventListener("scroll", function () {
    const currentScrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScrollTop > lastScrollTop && currentScrollTop > 300) {
        header.classList.add('hide')
    } else {
        header.classList.remove('hide')
    }
    lastScrollTop = currentScrollTop;
});



// function changeFilterParams(string) {
//     string = string.split('_');
//     if (string[1] == "category") {
//         categories.push(string[2])
//     }
//     else if (string[1] == "availability") {
//         availabilities.push(string[2])
//     }
//     else if (string[1] == "region") {
//         regions.push(string[2])
//     }
// }

