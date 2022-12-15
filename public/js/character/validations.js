
function nameValidate() {
    const name = asName()
    const errorMsgName = asErrorMsgName()
    errorMsgName.classList.add("form-invalid")
    const nameLength = name.length
    errorMsgName.textContent = '';
    if (!name) {
        errorMsgName.textContent = "キャラクター名を入力してください。"
        return false
    }
    if (nameLength > 50) {
        errorMsgName.textContent = "キャラクター名を50文字以内で入力してください。"
        return false
    }
    return true
}

function contentValidate() {
    const content = asContent()
    const errorMsgContent = asErrorMsgContent()
    const contentLength = content.length
    errorMsgContent.classList.add("form-invalid")
    errorMsgContent.textContent = "";
    if (!content) {
        errorMsgContent.textContent = "キャラクター説明を入力してください。"
        return false
    }
    if (contentLength > 1000) {
        errorMsgContent.textContent = "キャラクター説明は1000文字以内で入力してください。"
        return false
    }
    return true
}

function heightValidate() {
    const height = asHeight()
    const errorMsgHeight = asErrorMsgHeight()
    const heightDigits = height.toString().length
    errorMsgHeight.classList.add("form-invalid")
    errorMsgHeight.textContent = "";
    if (!height.match(/^[0-9]+$/) && !height == "") {
        errorMsgHeight.textContent = "半角数字のみを入力してください。"
        return false
    }
    if (heightDigits > 10) {
        errorMsgHeight.textContent = "数字は10桁以内で入力してください"
        return false
    }
    return true
}

function weightValidate() {
    const weight = asWeight()
    const errorMsgWeight = asErrorMsgWeight()
    const weightDigits = weight.toString().length
    errorMsgWeight.classList.add("form-invalid")
    errorMsgWeight.textContent = "";
    if (!weight.match(/^[0-9]+$/) && !weight == "") {
        errorMsgWeight.textContent = "半角数字のみを入力してください。"
        return false
    }
    if (weightDigits > 10) {
        errorMsgWeight.textContent = "数字は10桁以内で入力してください"
        return false
    }
    return true
}

function tribeValidate() {
    const tribe = getTribe()
    const errorMsgTribe = getErrorMsgTribe()
    errorMsgTribe.classList.add("form-invalid")
    errorMsgTribe.textContent = "";
    if(!tribe) {
        errorMsgTribe.textContent = "カテゴリーを選択してください。"
        return false
    }
    return true
}

function seasonValidate() {
    const season = getSeason()
    const errorMsgSeason = getErrorMsgSeason()
    errorMsgSeason.classList.add("form-invalid")
    errorMsgSeason.textContent = "";
    if(!season) {
        errorMsgSeason.textContent = "シーズンを選択してください。"
        return false
    }
    return true
}

function attackValidate() {
    const attack = getAttack()
    const errorMsgAttack = getErrorMsgAttack()
    errorMsgAttack.classList.add("form-invalid")
    errorMsgAttack.textContent = "";
    if(!attack) {
        errorMsgAttack.textContent = "攻撃を選択してください。"
        return false
    }
    return true
}

function defenseValidate() {
    const defence = getDefence()
    const errorMsgDefence = getErrorMsgDefence()
    errorMsgDefence.classList.add("form-invalid")
    errorMsgDefence.textContent = "";
    if(!defence) {
        errorMsgDefence.textContent = "守備を選択してください。"
        return false
    }
    return true
}

function abilityValidate() {
    const ability = getAbility()
    const errorMsgAbility = getErrorMsgAbility()
    errorMsgAbility.classList.add("form-invalid")
    errorMsgAbility.textContent = "";
    if(!ability) {
        errorMsgAbility.textContent = "潜在能力を選択してください。"
        return false
    }
}

function popularityValidate() {
    const popularity = getPopularity()
    const errorMsgPopularity = getErrorMsgPopularity()
    errorMsgPopularity.classList.add("form-invalid")
    errorMsgPopularity.textContent = "";
    if(!popularity) {
        errorMsgPopularity.textContent = "人気度を選択してください。"
        return false
    }
    return true
}