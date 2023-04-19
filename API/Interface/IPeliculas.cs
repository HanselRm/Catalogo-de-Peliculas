using API.Models;
using API.Models.Request;

namespace API.Interface
{
    public interface IPeliculas
    {
        IQueryable<Peliculas> GetAll();
        IQueryable<Peliculas> Getpeli(int id);
        IQueryable<Peliculas> GetporTitulo(string titulo, int id);
        IQueryable<Peliculas> GetporAño(DateTime fecha, int id);
        IQueryable<Peliculas> GetporDirector(string nombre, int id); 
        IQueryable<Peliculas> GetporGenero(string genero, int id); 
        IQueryable<Peliculas> PostPelicula(RequestPelicula pelicula, IFormFile imagen);
        IQueryable<Peliculas> PutPelicula(int id, RequestPelicula peli, IFormFile imagen);
        IQueryable<Peliculas> DeletePelicula(int id);

    }
}
