function validate(form) {
	if (form.fname.value === "") {
        window.alert("You must enter a first name");
        return false;
	}
	if (form.lname.value === "") {
        window.alert("You must enter a last name");
        return false;
	}
	if (form.mail.value === "") {
        window.alert("You must enter an e-mail address");
        return false;
	}
	if (form.num.value === "") {
        window.alert("You must enter a phone number");
        return false;
	}
    return true;  
}

function validateS(form) {
	if (form.name.value === "") {
        window.alert("You must enter a name");
        return false;
	}
	if (form.desc.value === "") {
        window.alert("You must enter a description");
        return false;
	}
	if (form.place.value === "") {
        window.alert("You must enter a pair of longitude, latitude coordinates");
        return false;
	}
}

function validateSearch(form) {
	if (form.dist.value === "") {
        window.alert("You must enter a distance from your location");
        return false;
	}
	if (form.rating.value === "") {
        window.alert("You must enter a rating");
        return false;
	}
	if (form.price.value === "") {
        window.alert("You must enter a price");
        return false;
	}
}