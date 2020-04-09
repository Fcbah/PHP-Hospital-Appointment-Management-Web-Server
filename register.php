<?php include_once('lib/header.php');?>
    <p><strong>Welcome, Please Register</strong></p>
    <p>All Fields are required</p>
    <form method="POST" action="processregister.php">
        <p>
            <label for="">First Name</label><br/>
            <input type="text" name= "first_name" placeholder="First Name" required/>
        </p>
        <p>
            <label for="">Last Name</label><br/>
            <input type="text" name= "last_name" placeholder="Last Name" required/>
        </p>
        <p>
            <label for="">Email</label><br/>
            <input type="email" name= "email" placeholder="Email" required/>
        </p>
        <p>
            <label for="">Password</label><br/>
            <input type="password" name= "password" placeholder="Password" required/>
        </p>
        <p>
            <label for="">Gender</label><br/>
            <select name="gender" id="" required>
            <option value="">Select One </option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </p>
        <p>
            <label for="">Designation</label><br/>
            <select name="designation" id="" required>
                <option value="">Select One</option>
                <option>Medical Team (MT)</option>
                <option>Patients</option>
            </select>            
        </p>
        <p>
            <label for="">Department</label><br/>
            <input type="text" name= "department" placeholder="Department" />
        </p>
        <p>
            <button type="submit">Register</button>
        </p>
    </form>
<?php include_once('lib/footer.php');?>