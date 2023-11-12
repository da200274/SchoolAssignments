void CocktailSort(int a[], int n)
{
    bool swapped = true;
    int start = 0;
    int end = n - 1;
 
    while (swapped)
    {
        swapped = false;
        for (int i = start; i < end; ++i){
            if (a[i] > a[i + 1]) {
                swap(a[i], a[i + 1]);
                swapped = true;
            }
        }
        if (!swapped) break;
        swapped = false;
        --end; //mozda ne treba
        for (int i = end - 1; i >= start; --i){
            if (a[i] > a[i + 1]) {
                swap(a[i], a[i + 1]);
                swapped = true;
            }
        }
        ++start; //mozda ne treba
    }
}
