//------------------ USER -------------------------
	function User(id) 						{ this.name = null; this.id = id; }
	User.prototype.setName = function(name) { this.name = name; }
	User.prototype.getName = function() 	{ return this.name; }
	User.prototype.getID = function() 		{ return this.id; }
	//--------------------------------------------------