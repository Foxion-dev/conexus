document.addEventListener("DOMContentLoaded", () => {

    const calculator = {
        buttonCalc: document.querySelector('#calc-btn'),
        calcBox: document.querySelector('.deal-calculator__result'),
        typeDealSelect: document.querySelector('select[name="type_id"]'),
        amountInput: document.querySelector('input[name="amount"]'),
        considerCommissionInput: document.querySelector('input[name="commission_on"]'),
        customCommissionInput: document.querySelector('input[name="edit_commission"]'),
        commissionInput: document.querySelector('input[name="percent_commission"]'),
        commissionSumInput: document.querySelector('input[name="amount_commission"]'),
        repaidSumInput: document.querySelector('input[name="issuance_amount"]'),
        repaidSum: 0,
        commissionPercent: 0,
        commissionSum: 0,
        customCommission: false,
        commissionMode: 'off',
        defaultCommission: 2,
        init(){
            const calc = this.defaultCalculate.bind(this);
            const changeCustomCommission = this.changeCustom.bind(this);
            const changeModeCommission = this.changeMode.bind(this);
            const changeCustomCommissionSum = this.changeCommissionSum.bind(this);
            const changeCustomReturnSum = this.changeReturnSum.bind(this);
            const changeCommissionValue = this.changeCommission.bind(this);
            const changeAmountValue = this.changeAmount.bind(this);
            const changeTypeDealValue = this.changeTypeDeal.bind(this);

            this.buttonCalc?.addEventListener('click', calc)
            this.customCommissionInput?.addEventListener('input', changeCustomCommission)
            this.commissionSumInput?.addEventListener('input', changeCustomCommissionSum)
            this.repaidSumInput?.addEventListener('input', changeCustomReturnSum)
            this.considerCommissionInput?.addEventListener('input', changeModeCommission)
            this.commissionInput?.addEventListener('input', changeCommissionValue)
            this.amountInput?.addEventListener('input', changeAmountValue)
            this.typeDealSelect?.addEventListener('input', changeTypeDealValue)
        },
        changeAmount(){
            this.calculate(this.commissionInput.classList.value, this.commissionSumInput.classList.value, this.repaidSumInput.classList.value);
        },
        changeTypeDeal(){
            this.setCommission();
            this.calculate(this.commissionInput.classList.value, this.commissionSumInput.classList.value, this.repaidSumInput.classList.value);
        },
        setCommission(){

            let typeDeal = +this.typeDealSelect.value;
            let amount = +this.amountInput.value;

            if(typeDeal === 1){ // продажа
                if(amount > 0 && amount <= 100){
                    this.defaultCommission = document.querySelector('input[data-type="sale"][data-from="0"]').getAttribute('data-value');
                }else if(amount > 100 && amount <= 1000){
                    this.defaultCommission = document.querySelector('input[data-type="sale"][data-from="100"]').getAttribute('data-value');
                }else if(amount > 1000 && amount <= 10000){
                    this.defaultCommission = document.querySelector('input[data-type="sale"][data-from="1000"]').getAttribute('data-value');
                }else if(amount > 10000 && amount <= 50000){
                    this.defaultCommission = document.querySelector('input[data-type="sale"][data-from="10000"]').getAttribute('data-value');
                }else if(amount > 50000 && amount <= 100000){
                    this.defaultCommission = document.querySelector('input[data-type="sale"][data-from="50000"]').getAttribute('data-value');
                }else if(amount > 100000){
                    this.defaultCommission = document.querySelector('input[data-type="sale"][data-from="100000"]').getAttribute('data-value');
                }
            }else if(typeDeal === 2){ // покупка
                if(amount > 0 && amount <= 100){
                    this.defaultCommission = document.querySelector('input[data-type="buy"][data-from="0"]').getAttribute('data-value');
                }else if(amount > 100 && amount <= 1000){
                    this.defaultCommission = document.querySelector('input[data-type="buy"][data-from="100"]').getAttribute('data-value');
                }else if(amount > 1000 && amount <= 10000){
                    this.defaultCommission = document.querySelector('input[data-type="buy"][data-from="1000"]').getAttribute('data-value');
                }else if(amount > 10000 && amount <= 50000){
                    this.defaultCommission = document.querySelector('input[data-type="buy"][data-from="10000"]').getAttribute('data-value');
                }else if(amount > 50000 && amount <= 100000){
                    this.defaultCommission = document.querySelector('input[data-type="buy"][data-from="50000"]').getAttribute('data-value');
                }else if(amount > 100000){
                    this.defaultCommission = document.querySelector('input[data-type="buy"][data-from="100000"]').getAttribute('data-value');
                }
            }

            this.commissionInput.value = this.defaultCommission;

        },
        changeCommission(event){
            if(this.customCommission){

                const {target} = event
                this.calculate(target.value);
            }
        },
        changeReturnSum(event){
            if(this.customCommission){

                const {target} = event
                this.calculate(0,0, target.value);
            }
        },
        changeCommissionSum(event){
            if(this.customCommission){

                const {target} = event
                this.calculate(0,target.value,0);

            }
        },
        changeMode(event){
            const {target} = event

            this.commissionMode = target.checked ? 'on' : 'off'
            this.calculate();
        },
        changeCustom(event){

            event.preventDefault();
            const {target} = event

            if(target.checked){
                this.customCommission = true;
                this.commissionInput.classList.remove('disabled')
                this.commissionSumInput.classList.remove('disabled')
                this.repaidSumInput.classList.remove('disabled')
            }else{
                this.customCommission = false;
                this.commissionInput.classList.add('disabled')
                this.commissionSumInput.classList.add('disabled')
                this.repaidSumInput.classList.add('disabled')
                this.commissionInput.value = this.defaultCommission
                this.calculate();

            }


        },
        defaultCalculate(event){

            event.preventDefault();
            const {target} = event


            if(this.amountInput.value && this.typeDealSelect.value){
                this.setCommission();
                console.log(this.defaultCommission)
                this.amountInput.classList.remove('is-invalid')
                this.typeDealSelect.classList.remove('is-invalid')

                if(!this.calcBox.classList.contains('show')){
                    this.calcBox.classList.add('show')
                }
                this.calculate();
            }else{
                this.amountInput.classList.add('is-invalid')
                this.typeDealSelect.classList.add('is-invalid')
            }
        },
        calculate(customCommission = 0, customCommissionSum = 0, customReturnSum = 0){

            let amountValue = +this.amountInput.value;
            let commissionPercent = customCommission > 0 ? customCommission : +this.commissionInput.value;
            let commissionSum = +this.amountInput.value / 100 * commissionPercent;
            let repaidSum = +this.amountInput.value - this.commissionSum;
            let commissionMode = this.commissionMode;

            if(customCommissionSum > 0){

                commissionPercent = (customCommissionSum / amountValue) * 100;
                commissionSum = customCommissionSum;
                repaidSum = commissionMode === 'off' ? (+amountValue + +commissionSum) : (+amountValue  - +commissionSum);

            }else if(customReturnSum > 0){

                repaidSum = customReturnSum
                commissionSum = customReturnSum - amountValue;
                commissionPercent = commissionSum / amountValue * 100;

            }else{
                commissionSum = amountValue / 100 * commissionPercent;
                repaidSum = commissionMode === 'off' ? (amountValue + commissionSum) : (amountValue  - commissionSum);
            }

            this.commissionPercent = Math.round(commissionPercent)
            this.commissionSum = Math.round(commissionSum)
            this.repaidSum = Math.round(repaidSum)
            this.setInputValues();

        },
        setInputValues(){
            this.commissionInput.value = this.commissionPercent
            this.repaidSumInput.value = this.repaidSum
            this.commissionSumInput.value = this.commissionSum;
        }
    }


    const clientSearch = {
        queryInput: document.querySelector('#search-client'),
        suggestBlock: document.querySelector('#search-suggest'),
        hiddenClientInput: document.querySelector('#hidden-client-id'),
        clientBlock: document.querySelector('.deal-form__client'),
        clientNameInput: document.querySelector('input[name="client_name"]'),
        clientContactInput: document.querySelector('input[name="client_contact"]'),
        clientCommentInput: document.querySelector('textarea[name="client_comment"]'),
        submitBtn: document.querySelector('button[type="submit"]'),
        clientSourceInput: document.querySelector('select[name="client_source"]'),
        lengthActive: 3,
        timeout:0,
        url: '/client-search',
        init(){
            if(this.timeout)  clearTimeout(this.timeout)

            const changeQueryValue = this.query.bind(this);

            this.queryInput.addEventListener('input', changeQueryValue)
        },
        query(event){
            const {target} = event
            const value = target.value

            if(this.timeout)  clearTimeout(this.timeout)

            if(value.length >= this.lengthActive){
                console.log(value);
                this.request(value)
            }

        },
        request(query){
            this.timeout = setTimeout(() => {
                const params = {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        query: query
                    })
                }
                const request = fetch(this.url, params)
                request.then(req => req.json())
                    .then(data => {
                        console.log(data)
                        if (data.length > 0) {
                            console.log(11)

                            this.cleanVariants()
                            data.forEach(elem => {
                                this.insertVariants(this.suggestBlock, this.createVariant(elem))
                            })
                            this.showSuggest()
                        }else{
                            console.log(2)
                            this.cleanVariants()
                            this.hideBottom()
                            this.insertNotFound()
                            this.showSuggest()
                        }
                    })
            }, 500)
        },
        cleanVariants(){
            this.suggestBlock.innerHTML = '';
        },
        insertVariants(parent, child) {
            parent.append(child)
        },
        insertNotFound() {
            const node = document.createElement('div')

            node.classList.add('suggest-list__btn')
            node.innerHTML = '<a class="btn btn-red" href="/clients/create" target="_blank">Не найдено, добавьте клиента</a>'

            this.suggestBlock.style.padding = 0
            this.suggestBlock.append(node)
        },
        createVariant(client) {

            const clientData = '<b>id</b> - ' + client.id + ' / ' +
                '<b>Имя</b> - ' + client.name + ' / ' +
                '<b>Контакт</b> - ' + client.contact;
            const node = document.createElement('div')
            const selectSuggestValue = this.selectVariants.bind(this);

            node.classList.add('suggest-list__item')
            node.setAttribute('data-id', client.id ?? '')
            node.setAttribute('data-name', client.name ?? '')
            node.setAttribute('data-contact', client.contact ?? '')
            node.setAttribute('data-comment', client.comment ?? '')
            node.setAttribute('data-source', client.source_id ?? '')

            node.innerHTML = clientData
            node.addEventListener('click', selectSuggestValue)

            return node
        },
        selectVariants(event){

            const {target} = event
            const element = target.classList.contains('suggest-list__item') ? target : target.closest('.suggest-list__item')

            const id = element.getAttribute('data-id')
            const name = element.getAttribute('data-name') ?? ''
            const contact = element.getAttribute('data-contact') ?? ''
            const comment = element.getAttribute('data-comment') === null ? '' : element.getAttribute('data-comment')
            const source = element.getAttribute('data-source') ?? ''

            this.queryInput.value = element.textContent
            this.clientContactInput.value = contact
            this.clientNameInput.value = name
            this.clientSourceInput.value = source
            this.clientCommentInput.innerHTML = comment
            this.hiddenClientInput.innerHTML = id

            this.clientSourceInput.querySelectorAll('option').forEach((option) => {
                if(option.value === id) option.checked
                option.checked = false
            })

            this.hideSuggest()
            this.showBottom()

        },
        showBottom(){
            if(!this.clientBlock.classList.contains('show')) this.clientBlock.classList.add('show')
            if(this.submitBtn.classList.contains('btn-disabled')) this.submitBtn.classList.remove('btn-disabled')
        },
        hideBottom(){
            if(this.clientBlock.classList.contains('show')) this.clientBlock.classList.remove('show')
            if(!this.submitBtn.classList.contains('btn-disabled')) this.submitBtn.classList.add('btn-disabled')
        },
        hideSuggest(){
            this.suggestBlock.classList.remove('show')
        },
        showSuggest(){
            if(!this.suggestBlock.classList.contains('show')) this.suggestBlock.classList.add('show')
        }
    }

    /*
    * Кастомный селект
    * */
    const selectCustom = {
        elements: document.querySelectorAll(".select-custom"),
        valueHandler() {
        },
        toggleList({target}) {
            const block = target.closest(".select-custom")
            block.classList.toggle("opened")
            if (block.classList.contains("opened")) {
                this.listBlock.style.maxHeight = `${this.list.scrollHeight + 2}px`
            } else {
                this.listBlock.style.maxHeight = `0px`
            }

        },
        closeList() {
            this.listBlock.closest(".select-custom").classList.remove("opened")
            this.listBlock.style.maxHeight = `0px`
        },
        chooseValue({target}) {
            const value = target.textContent
            this.label.style.opacity = `0`
            this.input.value = value
            this.closeList()
        },
        init() {
            if (this.elements.length) {
                this.elements.forEach(elem => {

                    const toggleNode = elem.querySelector(".select-custom__value")
                    this.listBlock = elem.querySelector(".select-custom__list")
                    this.list = this.listBlock.querySelector("ul")
                    this.listItems = this.list.querySelectorAll("li")
                    this.label = toggleNode.querySelector("label")
                    this.input = toggleNode.querySelector("input")
                    this.input.value = ""
                    const chooseBind = this.chooseValue.bind(this)
                    this.listItems.forEach(li => {
                        li.addEventListener("click", chooseBind)
                    })
                    const toggleBind = this.toggleList.bind(this)
                    toggleNode.addEventListener("click", toggleBind)
                })
            }
        }
    }

    calculator.init();
    clientSearch.init();
});
