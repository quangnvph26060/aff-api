export default function validator() {
    var check_number = /^\d+$/;
    var phoneNumber = /^\d{10,11}$/;
    var checkmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    const checkNumber = (value) => {
        return  check_number.test(value);
    }; 
     const checkPhoneNumber = (value) => {
        return  phoneNumber.test(value);
    };
    const checkEmail = (value) => {
        return checkmail.test(value);
    }

    return {
        checkNumber,
        checkPhoneNumber,
        checkEmail
    };
}
