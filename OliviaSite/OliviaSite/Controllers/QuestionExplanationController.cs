﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

// For more information on enabling MVC for empty projects, visit https://go.microsoft.com/fwlink/?LinkID=397860

namespace OliviaSite.Controllers
{
    public class QuestionExplanationController : Controller
    {
        // GET: /<controller>/
        [HttpGet]
        public IActionResult QuestionExplanation()
        {
            return View();
        }
    }
}