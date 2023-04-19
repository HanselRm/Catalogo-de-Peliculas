using API.Exceptions;
using API.Interface;
using API.Models;
using API.Models.Request;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace API.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class PeliculaController : ControllerBase
    {
        IPeliculas _service;

        public PeliculaController(IPeliculas service)
        {
            _service = service;
        }

        [HttpGet("get-All-Peliculas")]

        public IActionResult GetPeliculas() 
        {
            return Ok(_service.GetAll());
        }

        [HttpGet("get-one-pelicula")]

        public IActionResult GetOnePeli(int id)
        {
            return Ok(_service.Getpeli(id));
        }

        [HttpGet("get-Titulo")]
        public IActionResult getTitulo(string titulo, int id)
        {
            return Ok(_service.GetporTitulo(titulo, id));
        }

        [HttpGet("get-ano")]
        public IActionResult getTitulo(DateTime fecha, int id)
        {
            return Ok(_service.GetporAño(fecha, id));
        }

        [HttpGet("get-Director")]
        public IActionResult GetporDirector(string nombre, int id)
        {
            return Ok(_service.GetporDirector(nombre, id));
        }

        [HttpGet("get-Genero")]
        public IActionResult GetporGenero(string genero, int id)
        {
            return Ok(_service.GetporGenero(genero, id));
        }



        [HttpPost("Post-Pelicula")]

        public IActionResult postPeli([FromForm] RequestPelicula peli, [FromForm] IFormFile imagen)
        {
            try
            {
                return Ok(_service.PostPelicula(peli, imagen));
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest(ex.Message);
            }

        }


        [HttpPut("Put-Pelicula")]

        public IActionResult PutPeli([FromForm] int id, [FromForm] RequestPelicula peli, [FromForm] IFormFile imagen)
        {
            try
            {
                return Ok(_service.PutPelicula(id,peli, imagen));
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest(ex.Message);
            }

        }


        [HttpDelete("Delete-Pelicula")]
        public IActionResult Delete(int id)
        {
            try
            {
                return Ok(_service.DeletePelicula(id));
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest(ex.Message);
            }
            catch (Microsoft.EntityFrameworkCore.DbUpdateException ex)
            {
                Console.WriteLine(ex.Message);
                return BadRequest("Esta pelicula se esta usando");
            }
        }
    }
}
