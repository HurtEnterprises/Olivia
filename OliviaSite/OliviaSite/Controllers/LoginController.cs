using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

// For more information on enabling MVC for empty projects, visit https://go.microsoft.com/fwlink/?LinkID=397860

namespace OliviaSite.Controllers
{
    public class LoginController : Controller
    {
        // GET: /<controller>/
        [HttpGet]
        public IActionResult LoginBody()
        {
            return View();
        }

        public class LoginModel
        {
            public string Email { get; set;}
            public string Password { get; set; }
        }

        [HttpPost]
        public IActionResult LoginBody(LoginModel info)
        {
            System.Diagnostics.Debug.WriteLine(info.Email);
            System.Diagnostics.Debug.WriteLine(info.Password);

            //Some login Verification Logic

            //return View("~\\Views\\QuestionExplanation\\QuestionExplanation");
            return RedirectToAction("ShowView", "QuestionExplanation");
            //return View("~/Views/QuestionExplanation/QuestionExplanation.cshtml");
        }

    }
    //Justin's code here
    /*namespace LoginDialogForm
{
    public partial class Login_Dialog_Form1 : Form
            {
                public Login_Dialog_Form1()
                {
                    InitializeComponent();
                }
                private bool ValidateUsername()
                {
                    //TODO: add code to validate User Name.
                    return true;
                }
                private bool ValidatePassword()
                {
                    if (!ValidateUsername())
                    {
                        MessageBox.Show("Wrong Username", "Invalid Username", MessageBoxButtons.OK, MessageBoxIcon.Error);
                        return false;
                    }
                    else
                    {
                        //TODO: add code to validate password.
                        if (false)
                        {
                            MessageBox.Show("Wrong Password", "Invalid Password", MessageBoxButtons.OK, MessageBoxIcon.Error);
                            return false;
                        }
                        else
                            return true;
                        }
                    }
                }
                private void btnOk_Click(object sender, EventArgs e)
                {
                    if (!ValidatePassword())
                    {
                        txtUserName.Clear();
                        txtPassword.Clear();                
                        return;
                    }
                    else
                    {
                        this.DialogResult = DialogResult.OK;
                        this.Close();
                    }
                }
        
                private void btnCancel_Click(object sender, EventArgs e)
                {
                    txtUserName.Clear();
                    txtPassword.Clear();
                    this.Close();
                }
            }
        }
    
// Controls for the forms and their properties:
    
                // 
                // btnOk
                // 
                Name = "btnOk";
                Text = "&Ok";
                btnOk.Click += new System.EventHandler(this.btnOk_Click);
                // 
                // btnCancel
                // 
                DialogResult = System.Windows.Forms.DialogResult.Cancel;
                Name = "btnCancel";
                Text = "&Cancel";
                btnCancel.Click += new System.EventHandler(this.btnCancel_Click);
                // 
                // txtUserName
                // 
                Name = "txtUserName";
                // 
                // txtPassword
                // 
                PasswordChar = '*';
                Name = "txtPassword";
                // 
                // label1
                // 
                Name = "label1";
                Text = "Username";
                // 
                // label2
                // 
                Name = "label2";
                Text = "Password";
                // 
                // LogoPictureBox
                // 
                LogoPictureBox.Name = "LogoPictureBox";
                LogoPictureBox.TabStop = false;
                // 
                // LoginForm1
                // 
                AcceptButton = this.btnOk;
                CancelButton = this.btnCancel;
                ControlBox = false;
                FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedDialog;
                Name = "LoginForm1";
                ShowInTaskbar = false;
                StartPosition = System.Windows.Forms.FormStartPosition.CenterParent;
                Text = "Login Form";

// Code to call form
            private void Form1_Load(object sender, EventArgs e)
            {
                    
                    Login_Dialog_Form1 NewLogin = new Login_Dialog_Form1();                
                    DialogResult Result = NewLogin.ShowDialog();
                    switch (Result)
                    {
                        case DialogResult.OK:
                            break;
                        case DialogResult.Cancel:
                            this.Close();
                            break;
                    }
            } */
}
