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

            this.buttonCalc?.addEventListener('click', calc)
            this.customCommissionInput?.addEventListener('input', changeCustomCommission)
            this.commissionSumInput?.addEventListener('input', changeCustomCommissionSum)
            this.repaidSumInput?.addEventListener('input', changeCustomReturnSum)
            this.considerCommissionInput?.addEventListener('input', changeModeCommission)
            this.commissionInput?.addEventListener('input', changeCommissionValue)
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
});
