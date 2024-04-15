let url = window.location.href;
let url_segment = url.split('?');
let play_btn = document.getElementById('play');
let video = document.getElementById('video');

play_btn.addEventListener('click', () => {
    if (video.paused) {
        video.play();
        video.style.display = 'unset';
        play_btn.classList.remove('bi-play-fill');
        play_btn.classList.add('bi-pause');
    } else {
        video.pause();
        video.style.display = 'none';
        play_btn.classList.add('bi-play-fill');
        play_btn.classList.remove('bi-pause');
    }
});

let date = new Date();
let main_date = date.getDate();

Array.from(document.getElementsByClassName('date_point')).forEach(el => {
    if (el.innerText == main_date) {
        el.classList.add('h6_active');
    }
});

function initializeMovieData() {
    return [
        {
            pvr: 'PVR PreMax',
            movie: 'Boksi Ko Ghar',
            location: 'Gauradaha-01 ,Jhapa',
            audi: 2,
            type: '3D',
            series: ['J', 'H', 'F', 'E', 'D', 'C', 'B', 'A'],
            row_section: 3,
            seats: 24,
            j: [1, 2, 3, 5, 8, 9, 10],
            h: [1, 2, 3, 4, 5],
            f: [5, 6, 4, 2],
            e: [1, 2, 3, 4, 5, 6, 7, 8, 9],
            d: [4, 5, 6, 7, 8],
            c: [],
            b: [],
            a: [],
            price: [300],
            date: 23,
        },
        {
            pvr: 'PVR PreMax',
            movie: 'Boksi Ko Ghar',
            location: 'Gauradaha-01 ,Jhapa',
            audi: 1,
            type: '3D',
            series: ['J', 'H', 'F', 'E', 'D', 'C', 'B', 'A'],
            row_section: 3,
            seats: 24,
            j: [1, 2, 3, 5, 8, 9, 10],
            h: [1, 2, 3, 4, 5],
            f: [5, 6, 4, 2],
            e: [1, 2, 3, 4, 5, 6, 7, 8, 9],
            d: [4, 5, 6, 7, 8],
            c: [],
            b: [],
            a: [],
            price: [300],
            date: 24,
        },
    ];
}

const pvr = initializeMovieData();
let data = pvr.filter(obj => obj.date === main_date && obj.movie === url_segment[1]);

function addSeats(arr) {
    arr.forEach(movie => {
        const { series, seats } = movie;
        series.forEach(row => {
            let rowElement = document.createElement('div');
            rowElement.className = 'row';

            let bookedSeats = movie[row.toLowerCase()];

            for (let seatIndex = 1; seatIndex <= seats; seatIndex++) {
                let seat = document.createElement('li');
                if (bookedSeats.includes(seatIndex)) {
                    seat.className = "seat booked";
                } else {
                    seat.className = "seat";
                }
                rowElement.appendChild(seat);
            }

            document.getElementById('chair').appendChild(rowElement);
        });
    });
}

addSeats(data);
