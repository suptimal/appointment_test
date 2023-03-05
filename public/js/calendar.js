class Calendar {
    
    #date = new Date()
    #currYear = this.#date.getFullYear()
    #currMonth = this.#date.getMonth()
    #parent = undefined

    #months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
    #days = ["Mon", "Thu", "Wed", "Thu", "Fri", "Sat", "Sun"]


    constructor(parent_selector, locale = "de"){
        this.#parent = document.querySelector(parent_selector)
    

        switch (locale) {
            case 'de':
                this.#months = ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli",
                "August", "September", "Oktober", "November", "Dezember"]
                this.#days = ["Mo", "Di", "Mi", "Do", "Fr", "Sa", "So"]
                break;
        }
        this.renderCalendar()
    }

    renderCalendar() {
        // getting first day of month
        let firstDayofMonth = new Date(this.#currYear, this.#currMonth, 1).getDay() 
        firstDayofMonth = firstDayofMonth == 0 ? 6 : firstDayofMonth -1
        // getting last date of month
        let lastDateofMonth = new Date(this.#currYear, this.#currMonth + 1, 0).getDate()
        let lastDayofMonth = new Date(this.#currYear, this.#currMonth, lastDateofMonth).getDay() // getting last day of month
        lastDayofMonth = lastDayofMonth == 0 ? 6 : lastDayofMonth -1
        let lastDateofLastMonth = new Date(this.#currYear, this.#currMonth, 0).getDate() // getting last date of previous month
        this.#parent.innerHTML = ''
        let cal_div = document.createElement('div')
        cal_div.className = 'my_calendar card'
        let cal_header = document.createElement('header')

        let date_display = document.createElement('p')
        date_display.innerText = this.#months[this.#currMonth] + ' ' + this.#currYear
        cal_header.appendChild(date_display)

        let next_month = document.createElement('span')
        let prev_month = document.createElement('span')
        next_month.classList = 'material-symbols-rounded icon'
        prev_month.classList = 'material-symbols-rounded icon'
        next_month.innerText = 'chevron_right'
        prev_month.innerText = 'chevron_left'
        next_month.addEventListener('click', () => this.#changeMonth(+1))
        prev_month.addEventListener('click', () => this.#changeMonth(-1))

        let icons = document.createElement('span')
        icons.appendChild(prev_month)
        icons.appendChild(next_month)

        cal_header.appendChild(icons)

        // days in header
        let cal_weekdays = document.createElement('ul')
        this.#days.forEach(day => {
            this.#appendDay(cal_weekdays, 'li', day, '')
        });

        cal_div.appendChild(cal_header)
        cal_div.appendChild(cal_weekdays)
        
        let cal_days = document.createElement('ul')
        
        // creating li of previous month last days
        for (let i = firstDayofMonth; i > 0; i--) { 
            this.#appendDay(cal_days, 'li', lastDateofLastMonth - i + 1)
        }
        
        // creating li of all days of current month
        for (let i = 1; i <= lastDateofMonth; i++) {
            // adding active class to li if the current day, month, and year matched
            let classList = i === new Date().getDate() && this.#currMonth === new Date().getMonth()
            && this.#currYear === new Date().getFullYear() ? "active" : "";
            classList = classList + " availible_date"
            let el = this.#appendDay(cal_days, 'li', i, classList)
            let d = this.#currYear + "-" + String(this.#currMonth).padStart(2, 0) + "-" + String(i).padStart(2, 0)
            el.addEventListener('click', (e) => {console.log(d)})
        }

        // creating li of next month first days
        for (let i = lastDayofMonth; i < 6; i++) { 
            this.#appendDay(cal_days, 'li', i - lastDayofMonth + 1)
        }
        
        cal_div.appendChild(cal_days)
        this.#parent.appendChild(cal_div)
    }

    #appendDay(parent, type, text, classList = 'inactive'){
        let el = document.createElement(type)
        el.innerText = text
        el.classList = classList
        parent.appendChild(el)
        return el
    }

    #changeMonth(amount){
        this.#currMonth += amount

        if (this.#currMonth > 11) {
            this.#currYear += 1
            this.#currMonth = 0
        } else if ( this.#currMonth < 0 ){
            this.#currMonth = 11
            this.#currYear -= 1
        }
        this.renderCalendar()
    }
    
}    
