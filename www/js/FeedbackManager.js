	function FeedbackManager(infoFieldId, formFieldId) {
		this.infoFieldId = infoFieldId;	//field feedback
		this.formFieldId = formFieldId; //form feedback
	}

	FeedbackManager.prototype.sendInfo = function(info,contID) {
		var fieldID = this.infoFieldId;
		if(contID !== undefined && contID !== null) fieldID = contID;
		document.getElementById(fieldID).innerHTML = info;
	}

	FeedbackManager.prototype.sendFeedback = function(feedback) {
		document.getElementById(this.formFieldId).innerHTML = feedback;
	}