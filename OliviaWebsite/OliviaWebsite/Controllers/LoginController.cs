﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

// For more information on enabling MVC for empty projects, visit https://go.microsoft.com/fwlink/?LinkID=397860

namespace OliviaWebsite.Controllers
{
    public class LoginController : Controller
    {
        // GET: /<controller>/
        public IActionResult LoginBody()
        {
            return View();
        }

        public string Welcome()
        {
            return "This is the Welcome action method...";
        }
    }
}
