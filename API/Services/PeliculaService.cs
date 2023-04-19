using API.Context;
using API.Exceptions;
using API.Interface;
using API.Models;
using API.Models.Request;
using Microsoft.EntityFrameworkCore;

namespace API.Services
{
    public class PeliculaService : IPeliculas
    {
        public PFCatalogoContext _context { get; set; }
        public GeneroService _serviceGenero { get; set; }

        public PeliculaService(PFCatalogoContext context)
        {
            _context = context;
        }

        public IQueryable<Peliculas> GetAll()
        {
            return _context.Peliculas.Include(g => g.Genero).Include(i => i.Imagen).Include(p => p.Persona);
        }

        public IQueryable<Peliculas> Getpeli(int id)
        {
            return _context.Peliculas.Include(g => g.Genero).Include(i => i.Imagen).Include(p => p.Persona).Where(p => p.IdPersona == id);
        }

        //Filtros
        public IQueryable<Peliculas> GetporTitulo(string titulo, int id)
        {
            return _context.Peliculas.Include(g => g.Genero).Include(i => i.Imagen).Include(p => p.Persona).
                                                    Where(p => p.Titulo == titulo && p.IdPersona == id);
        }

        public IQueryable<Peliculas> GetporAño(DateTime fecha, int id)
        {
            return _context.Peliculas.Include(g => g.Genero).Include(i => i.Imagen).Include(p => p.Persona).
                                                    Where(p => p.Año == fecha && p.IdPersona == id);
        }

        public IQueryable<Peliculas> GetporDirector(string nombre, int id)
        {
            return _context.Peliculas.Include(g => g.Genero).Include(i => i.Imagen).Include(p => p.Persona).
                                                    Where(p => p.NombreDirector + " " + p.ApellidoDirector == nombre && p.IdPersona == id);
        }

        public IQueryable<Peliculas> GetporGenero(string genero, int id)
        {
            return _context.Peliculas.Include(g => g.Genero).Include(i => i.Imagen).Include(p => p.Persona).
                                                    Where(p => p.Genero.Genero == genero && p.IdPersona == id);
        }

        public IQueryable<Peliculas> PostPelicula(RequestPelicula pelicula, IFormFile imagen)
        {
            try
            {
                List<Peliculas> lista = new List<Peliculas>();
                lista = GetAll().ToList();
                Peliculas pel = new Peliculas();
                pel = lista.Find(p => p.Titulo == pelicula.Titulo && p.IdPersona == pelicula.IdPersona);

                if (pel != null)
                {
                    throw new GeneralExeption("Esta pelicula esta registrada");
                }
                else
                {
                    Imagen img = SubirImagen(imagen);

                    img = _context.Imagen.FirstOrDefault(i => i.Nombre == img.Nombre);

                    Peliculas peli = new Peliculas
                    {
                        Titulo = pelicula.Titulo,
                        Año = pelicula.Año,
                        NombreDirector = pelicula.NombreDirector,
                        ApellidoDirector = pelicula.ApellidoDirector,
                        IdGenero = pelicula.IdGenero,
                        IdImagen = img.IdImagen,
                        IdPersona = pelicula.IdPersona
                    };
                    _context.Peliculas.Add(peli);
                    _context.SaveChanges();
                }



            }
            catch (GeneralExeption ex)
            {
                throw;
            }

            return _context.Peliculas;
        }

        public Imagen SubirImagen(IFormFile file)
        {
            string ruta = "C:\\xampp\\htdocs\\Cliente\\imagenes";
            string nombre = Guid.NewGuid().ToString() + file.ContentType;

            var archivo = Path.Combine(ruta, nombre);

            using (var stream = File.Create(archivo))
            {
                file.CopyTo(stream);
            }
            return GuadarImagen(ruta, nombre);

        }

        private Imagen GuadarImagen(string ruta, string nombre)
        {
            Imagen imagen = new Imagen
            {
                Ruta = ruta,
                Nombre = nombre
            };
            _context.Imagen.Add(imagen);
            _context.SaveChanges();
            return imagen;
        }

        public IQueryable<Peliculas> PutPelicula(int id, RequestPelicula peli, IFormFile imagen)
        {

            var peliculaExistente = _context.Peliculas.Find(id);

            try
            {
                if (peliculaExistente == null)
                {
                    throw new GeneralExeption("Esta Pelicula  no existe");
                }
                else
                {
                    Imagen img = SubirImagen(imagen);

                    img = _context.Imagen.FirstOrDefault(i => i.Nombre == img.Nombre);

                    peliculaExistente.Titulo = peli.Titulo;
                    peliculaExistente.NombreDirector = peli.NombreDirector;
                    peliculaExistente.ApellidoDirector = peli.ApellidoDirector;
                    peliculaExistente.Año = peli.Año;
                    peliculaExistente.IdGenero = peli.IdGenero;
                    peliculaExistente.IdImagen = img.IdImagen;
                    _context.SaveChanges();
                    return GetAll();
                }
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                throw;
            }
        }

        public IQueryable<Peliculas> DeletePelicula(int id)
        {
            var peliculaDelete = _context.Peliculas.Find(id);
            try
            {
                if (peliculaDelete == null)
                {
                    throw new GeneralExeption("Esta pelicula no existe");
                }
                else
                {
                    _context.Peliculas.Remove(peliculaDelete);
                    _context.SaveChanges();
                    return GetAll();
                }
            }
            catch (GeneralExeption ex)
            {
                Console.WriteLine(ex.Message);
                throw;
            }
        }
    }
}
