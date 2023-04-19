using API.Exceptions;
using API.Interface;
using API.Models;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace API.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class GeneroController : ControllerBase
    {
        IGenero _service;
        public GeneroController(IGenero service)
        {
            _service = service;
        }

        [HttpGet("get-All-Generos")]

        public IActionResult GetAll() 
        {    
            return Ok(_service.GetAll());
        }

        [HttpGet("getOne")]
        public IActionResult GetOne(int id)
        {
            try
            {
                return Ok(_service.getId(id));
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest(ex.Message);
            }
        }
        

        [HttpPost("Post-Genero")]

        public IActionResult Post(Generos genero)
        {
            try
            {
                return Ok(_service.PostGenero(genero));
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest(ex.Message);
            }
        }

        [HttpPut("Put-Genero")]

        public IActionResult Put(int id, [FromBody] Generos genero)
        {
            try
            {
                return Ok(_service.PutGenero(id,genero));
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest(ex.Message);
            }
        }


        [HttpDelete("Delete-Genero")]
        public IActionResult Delete(int id)
        {
            try
            {
                return Ok(_service.DeleteGenero(id));
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest(ex.Message);
            }
            catch (Microsoft.EntityFrameworkCore.DbUpdateException ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest("Este genero se esta utilizando en una pelicula");
            }
        }
    }
}
