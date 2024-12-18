

function checkRequired(value) {
    if (value == "" || value.trim() === "") {
        return false;
    }
    return true;
}
function checkInteger(value) {
    if (value.match(/^\d+$/)) {
        return true;
    }
    return false;
}
function checkCharacterPhone(value) {
    if (value.match(/^\d{10}$|^\d{11}$/)) {
        return true;
    }
    return false;
}
function checkEmail(value) {
    if (value.match(/^[\w\.-]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$/)) {
        return true;
    }
    return false;
}
function checkLength(value, length) {
    if (!(value.length >= length)) {
        return false;
    }
    return true;
}
function checkPass(value) {
    if (value.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/)) {
        return true;
    }
    return false;
}
function checkYear(value, year) {
    if (value >= year) {
        return true;
    }
    return false;
}
function checkURL(value) {
    if (value.match(/^http(s)?:\/\/([\w-]+\.)+[\w-]+(\/[\w-.\/?%&=]*)?/)) {
        return true;
    }
    return false;

}
function validateAllFields(data){
    var isValid = true;
    for (var fieldName in data) {
       if (!validateField(fieldName, data)) {
           isValid = false;
       }
    }
    return isValid;
}
function validateField(fieldName, data) {
    var fieldValue = data[fieldName].element.value;
    var errorContainer = data[fieldName].error;
    var inputElement = data[fieldName].element;
    var validations = data[fieldName].validations;
    var hasError = false;
    var formElement = data[fieldName].element.form;
    for (var i = 0; i < validations.length; i++) {
        if (!validations[i].func(fieldValue)) {
            errorContainer.textContent = validations[i].message;
            inputElement.classList.add("is-invalid");
            hasError = true;
            break;
        }
    }
    if (hasError) {
        var firstInvalidInput = formElement.querySelector('.is-invalid');
        if (firstInvalidInput) {
            firstInvalidInput.scrollIntoView({ block: 'center', behavior: 'smooth' });
            firstInvalidInput.focus();
        }
        return false;
    }
    errorContainer.textContent = "";
    inputElement.classList.remove("is-invalid");
    return true;
}
function generateErrorMessage(code, values = []) {
    const errorMessages = {
        E001: 'Mật khẩu không để trống',
        E002: 'Mật khẩu ít nhất 8 ký tự',
        E003: 'Vui lòng nhập tìm kiếm',
        E004: 'Số CCCD không được để trống',
        E005: 'Số CCCD  it nhất 10 ký tự',
        E006: 'Ngân hàng không được để trống',
        E007: 'Số tài khoản ngân hàng không được để trống',
        E008: 'Tên chủ tài khoản không được để trống',
        E009: 'Tên chủ tài khoản it nhât 4 ký tự',
        // sản phẩm
        E0010: 'Tên sản phẩm không được để trống',
        E0011: 'Ảnh không được để trống',
        E0012: 'Giá sản phẩm không được dể trông',
        E0013: 'Số lượng sản phẩm không được dể trông',
        E0014: 'Hoa hồng không được để sống',
        E0015: 'Loại danh mục không dược để trống',
        E0016: 'Mô tả không được để trống',
        E0017: 'Trạng thái không được để trống',
        E0018: ' Không được để trống ',
        E019: 'Vui lòng nhập họ tên',
        E020: 'Địa chỉ không được để trống',
        E021: 'Vui lòng chọn thành phố',
        E022: 'Vui lòng chọn quận/huyện',
        E023: 'Vui lòng chọn phường/xã',
        E024: 'Điện thoại không để trống',
        E025: 'Email không được để trống',
        E026: 'Tài khoản không để trống',
        // thuong hieu
        E027: ' Thương hiệu không để trống',
        E028: ' Logo không để trống',
        E029: ' Email không để trống',
        E030: ' Số điện thoại không để trống',
        E031: ' Địa chỉ không để trống',



    };
    const errorMessage = errorMessages[code];
    if (typeof errorMessage === 'function') {
        return errorMessage(values);
    }
    return errorMessage;
}
