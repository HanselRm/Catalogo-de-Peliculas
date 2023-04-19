using API.Models;

namespace API.Interface
{
    public interface IGenero
    {
        IQueryable<Generos> GetAll();
        IQueryable getId(int id);
        IQueryable PostGenero(Generos genero);
        IQueryable PutGenero(int id, Generos genero);
        IQueryable DeleteGenero(int id);
    }
}
