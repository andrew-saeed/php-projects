<?

namespace App\Core;

class Config {

    protected array $config = [];

    public function merge(array $config) {
        $this->config = array_merge_recursive($this->config, $config);

        // var_dump($this->config);
        // var_dump(dot($this->config)->get('base'));
        return $this;
    }

    public function get(string $key, $default = null) {

        return dot($this->config)->get($key) ?? $default;
    }
}