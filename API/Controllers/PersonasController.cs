using API.Exceptions;
using API.Interface;
using API.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace API.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class PersonasController : ControllerBase
    {
        IPersonas _service;

        public PersonasController(IPersonas service)
        {
            _service = service;
        }

        [HttpGet("get-All-Personas")]
        public IActionResult GetPeliculas()
        {
            return Ok(_service.GetAll());
        }

        [HttpGet("Get-Por-Correo")]
        public IActionResult GetPorCorreo(string correo, string contra)
        {
            try
            {
                return Ok(_service.GetPorCorreo(correo, contra));
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest(ex.Message);
            }
            
        }

        [HttpPost("post-Personas")]

        public IActionResult PostPeliculas([FromBody] Personas person)
        {
            try
            {
                return Ok(_service.PostPersona(person)); 
            }
            catch(GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest( ex.Message);
            }
            
            
        }

    }
}
